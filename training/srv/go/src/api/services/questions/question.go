package questions

import (
	"api/errors"
	"api/helpers"
	"api/models"
	"api/services"
	"database/sql"
	"encoding/json"
	"math"
	"net/http"
)

type QuestionResponseSchema struct {
	Id int64 `json:"id"`
}

type QuestionsListingSchema struct {
	ID                  int                       `json:"id"`
	QuestionText        string                    `json:"questionText"`
	QuestionType        string                    `json:"questionType"`
	Options             []string                  `json:"options"`
	RelationalOperation *string                   `json:"relationalOperation"`
	CorrectResponse     []string                  `json:"correctResponse"`
	ChildQuestions      []*QuestionsListingSchema `json:"childQuestions"`
}

type QuestionsListingResponse struct {
	CurrentPage int                       `json:"currentPage"`
	Pages       int                       `json:"pages"`
	Questions   []*QuestionsListingSchema `json:"questions"`
}

func CreateQuestion(db *sql.DB, reqBody []byte) (QuestionResponseSchema, error) {

	var requestBody models.QuestionSchema
	var Response QuestionResponseSchema

	if err := json.Unmarshal(reqBody, &requestBody); err != nil {
		return QuestionResponseSchema{}, errors.NewHTTPError(nil, http.StatusBadRequest, "Bad Request:Invalid json")
	}

	if len(requestBody.Options) == 0 {
		requestBody.Options = nil
	}

	if helpers.IsEmpty(requestBody.RelationalOp) {
		requestBody.RelationalOp = "="
	}

	if requestBody.RelatedTo != 0 {

		if err := models.IsItRelatedToChildQuestion(db, requestBody.RelatedTo); err != nil {
			return QuestionResponseSchema{}, err
		}

		if err := models.DoesParentContainMaximumChildren(db, requestBody.RelatedTo); err != nil {
			return QuestionResponseSchema{}, err
		}
	}

	if err := ValidateQuestionFields(db, requestBody, -1); err != nil {
		return QuestionResponseSchema{}, err
	}

	// insert the question in the database
	if id, err := models.CreateQuestion(db, requestBody); err != nil {
		return QuestionResponseSchema{}, err
	} else {
		Response = QuestionResponseSchema{Id: id}
	}

	return Response, nil
}

func EditQuestion(db *sql.DB, reqBody []byte, id int) (models.QuestionResponseSchema, error) {
	var requestBody models.QuestionSchema

	if err := json.Unmarshal(reqBody, &requestBody); err != nil {
		return models.QuestionResponseSchema{}, errors.NewHTTPError(nil, http.StatusBadRequest, "Bad Request:Invalid json")
	}

	err := ValidateQuestionIDs(db, id, requestBody.RelatedTo)

	if err != nil {
		return models.QuestionResponseSchema{}, err
	}

	if helpers.IsEmpty(requestBody.RelationalOp) {
		requestBody.RelationalOp = "="
	}

	if err = ValidateQuestionFields(db, requestBody, id); err != nil {
		return models.QuestionResponseSchema{}, err
	}

	//updating various question related fields in the database
	if err = models.EditQuestion(db, requestBody, id); err != nil {
		return models.QuestionResponseSchema{}, err
	}
	responseBody := models.QuestionResponseSchema(requestBody)

	return responseBody, nil
}

func GetQuestions(db *sql.DB, sectionID, page int) (QuestionsListingResponse, error) {
	var response QuestionsListingResponse
	var parentQuestions, childQuestions []models.Question
	var numberOfQuestions int
	var err error

	if count, err := services.IsIdExist(db, "sections", sectionID); err != nil {
		return response, err
	} else if count == 0 {
		return response, errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid Section ID")
	}

	if numberOfQuestions, err = models.GetTotalNumberOfQuestions(db, sectionID); err != nil {
		return response, err
	}

	size := 5
	totalNumberOfPages := int(math.Ceil(float64(numberOfQuestions) / float64(size)))
	if page < 1 || page > totalNumberOfPages {
		return response, errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid Page Number")
	}

	if parentQuestions, childQuestions, err = models.GetQuestions(db, sectionID, page, size); err != nil {
		return response, err
	}

	if questions, err := GetQuestionsResponse(parentQuestions, childQuestions); err != nil {
		return response, err
	} else {
		response = QuestionsListingResponse{CurrentPage: page, Pages: totalNumberOfPages, Questions: questions}
		return response, nil
	}
}

func DeleteQuestion(db *sql.DB, qId int) error {

	if rowCount, err := services.IsIdExist(db, "questions", qId); err != nil {
		return err
	} else if rowCount == 0 {
		return errors.NewHTTPError(nil, http.StatusNotFound, "Question not found.")
	}

	err := models.DeleteQuestion(db, qId)

	if err != nil {
		return err
	}

	return nil
}
