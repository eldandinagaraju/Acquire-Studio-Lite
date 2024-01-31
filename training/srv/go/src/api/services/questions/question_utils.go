package questions

import (
	"api/constants"
	"api/errors"
	"api/models"
	"api/services"
	"database/sql"
	"encoding/json"
	"net/http"
	"regexp"
	"strings"
)

// check if the question is related to a child question
// get the questions in QuestionsListingSchema structure
func GetQuestionsResponse(parentQuestions, childQuestions []models.Question) ([]*QuestionsListingSchema, error) {
	var questionsResponse = []*QuestionsListingSchema{}

	for _, row := range parentQuestions {
		if question, err := ConvertToJSON(row); err != nil {
			return questionsResponse, err
		} else {
			questionsResponse = append(questionsResponse, &question)
		}
	}

	for _, row := range childQuestions {
		if question, err := ConvertToJSON(row); err != nil {
			return questionsResponse, err
		} else {
			FindParent(row.RelatedTo, &question, questionsResponse)
		}
	}

	return questionsResponse, nil
}

// to convert the options and correctResponse from string to JSON and return the question
func ConvertToJSON(question models.Question) (QuestionsListingSchema, error) {
	var correctResponseValues []string = []string{}
	var optionValues []string = []string{}
	if question.Options != "" {
		if err := json.Unmarshal([]byte(question.Options), &optionValues); err != nil {
			return QuestionsListingSchema{}, err
		}
	}

	if question.CorrectResponse != "" {
		if err := json.Unmarshal([]byte(question.CorrectResponse), &correctResponseValues); err != nil {
			return QuestionsListingSchema{}, err
		}
	}

	var relationalOp *string
	if question.RelationalOperation == "" {
		relationalOp = nil
	} else {
		relationalOp = &question.RelationalOperation
	}

	q := QuestionsListingSchema{
		ID:                  question.ID,
		QuestionText:        question.QuestionText,
		QuestionType:        question.QuestionType,
		Options:             optionValues,
		RelationalOperation: relationalOp,
		CorrectResponse:     correctResponseValues,
		ChildQuestions:      []*QuestionsListingSchema{},
	}

	return q, nil
}

// to find the parent question for child questions
func FindParent(parentID int, child *QuestionsListingSchema, questions []*QuestionsListingSchema) {

	for _, question := range questions {
		if question.ID == parentID {
			question.ChildQuestions = append(question.ChildQuestions, child)
			return
		}
	}
}

// check if the given array is the sub array of the other given sub array or not
func isSubArray(mainArr []string, subArray []string) bool {
	for i := 0; i <= len(mainArr)-len(subArray); i++ {
		found := true

		// Compare each element of the subarray with the corresponding element in the main array
		for j := 0; j < len(subArray); j++ {
			if mainArr[i+j] != subArray[j] {
				found = false
				break
			}
		}

		if found {
			return true
		}
	}

	return false
}

func ValidateQuestionFields(db *sql.DB, requestBody models.QuestionSchema, id int) error { // done

	if err := ValidateQuestionText(db, requestBody.QuestionText, requestBody.RelatedTo, requestBody.SectionID, id); err != nil {
		return err
	}

	if err := ValidateQuestionType(requestBody.QuestionType, requestBody.Options); err != nil {
		return err
	}

	// check whether the section exists or not
	if rowCount, err := services.IsIdExist(db, "sections", requestBody.SectionID); err != nil {
		return err
	} else if rowCount == 0 {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid Section ID")
	}

	// we receive 0 as the default value for the int type if we dont send anyting in the req body
	if requestBody.RelatedTo != 0 {

		// check whether the parent question  exists in the same section as the child question or not
		if rowCount, err := models.IsQuestionExistInSection(db, requestBody.RelatedTo, requestBody.SectionID); err != nil {
			return err
		} else if rowCount == 0 {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "Parent and Child Questions should Exist in the same section")
		} else if err := ValidateCorrectResponse(db, requestBody.RelationalOp, requestBody.RelatedTo, requestBody.CorrectResponse); err != nil {
			return err
		}
	} else if len(requestBody.CorrectResponse) != 0 { // case where you do not have parent question but have the correct response (we are storing the response of the parent question in the correct response field of the child question so that for that response this child question will be fetched)
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Correct Response Should be empty")
	}

	return nil

}

func ValidateQuestionText(db *sql.DB, questionText string, parentID int, sectionID int, id int) error { // done
	var isQuestionText = regexp.MustCompile("^[a-zA-Z' ]{5}[a-zA-Z0-9@,.'  -]{1,250}[?]?$")

	if !isQuestionText.MatchString(questionText) {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid Question Text")
	} else {
		if parentID != 0 {
			if pText, err := models.FetchQuestionText(db, parentID); err != nil {
				return err
			} else if strings.EqualFold(questionText, pText) {
				return errors.NewHTTPError(nil, http.StatusBadRequest, "Cannot have same parent and child question")
			} else if err := ValidateChildQuestions(db, parentID, questionText, id); err != nil {
				return err
			}
		} else {
			if rowCount, err := models.IsParentQuestionExist(db, questionText, sectionID, id); err != nil {
				return err
			} else if rowCount != 0 {
				return errors.NewHTTPError(nil, http.StatusBadRequest, "This Question Already Exists")
			}
		}
	}
	return nil
}

func ValidateChildQuestions(db *sql.DB, parentID int, qText string, id int) error {
	var invalid bool // done
	if childQuestions, err := models.GetChildQuestions(db, parentID, id); err != nil {
		return err
	} else {
		for i := 0; i < len(childQuestions); i++ {
			if strings.EqualFold(childQuestions[i], qText) {
				invalid = true
				break
			}
		}
		if invalid {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "This child question already exists")
		}
	}
	return nil
}

func ValidateQuestionType(qType string, options []string) error { // done

	switch qType {
	case constants.SingleSelect:
		if len(options) == 0 {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "Options should not be empty")
		}
	case constants.MultiSelect:
		if len(options) == 0 {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "Options should not be empty")
		}
	case constants.TextType:
		if len(options) != 0 {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "Options should be empty")
		}
	case constants.IntegerType:
		if len(options) != 0 {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "Options should be empty")
		}
	default:
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid Question Type")
	}

	return nil

}

func ValidateQuestionIDs(db *sql.DB, questionID int, parentID int) error { // done

	rowCount, err := services.IsIdExist(db, "questions", questionID)

	if err != nil {
		return err
	} else if rowCount == 0 {
		return errors.NewHTTPError(nil, http.StatusNotFound, "Question not found.")
	}

	rowCount, err = services.IsIdExistAndActive(db, "questions", questionID)

	if err != nil {
		return err
	} else if rowCount == 0 {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Cannot update this Question.")
	}

	if parentID != 0 {
		if err := models.IsItRelatedToChildQuestion(db, parentID); err != nil {
			return err
		}

		if err := models.DoesParentContainMaximumChildren(db, parentID); err != nil {
			return err
		}
	}
	return nil

}

func ValidateRelationalOperator(relOp string, qType string) error { // done
	relationalOperators := map[string]bool{"=": true, "!=": true, ">": true, ">=": true, "<": true, "<=": true}

	if !relationalOperators[relOp] {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid Relational Operator")
	} else if qType != "INT_TYPE" && relOp != "=" && relOp != "!=" {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid Relational Operator for this type questions")
	}

	return nil
}

func ValidateCorrectResponse(db *sql.DB, relationalOp string, id int, correctResponse []string) error { // done
	var optionsArray []string

	if len(correctResponse) == 0 {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Correct Response cannot  be empty")
	}

	if qType, optionsString, err := models.FetchQuestionDetails(db, id); err != nil {
		return err
	} else if err := checkCorrrectReponse(qType, correctResponse); err != nil {
		return err
	} else if err := ValidateRelationalOperator(relationalOp, qType); err != nil {
		return err
	} else if qType != "TEXT_TYPE" && qType != "INT_TYPE" {
		if err := json.Unmarshal([]byte(optionsString), &optionsArray); err != nil {
			return err
		} else if err := isSubArray(optionsArray, correctResponse); !err {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid Correct Response")
		}
	}
	return nil
}

func checkCorrrectReponse(qType string, correctResponse []string) error { // done

	if qType != "MULTI_SELECT" && len(correctResponse) != 1 {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Correct Response should have only one option")
	}
	return nil
}
