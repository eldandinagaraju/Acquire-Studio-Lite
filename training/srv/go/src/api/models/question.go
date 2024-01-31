package models

import (
	"api/errors"
	"api/helpers"
	"database/sql"
	"fmt"
	"math/rand"
	"net/http"
	"strconv"

	"github.com/beego/beego/v2/client/orm"
)

type QuestionSchema struct {
	QuestionText    string   `json:"questionText"`
	QuestionType    string   `json:"questionType"`
	SectionID       int      `json:"sectionId"`
	Options         []string `json:"options"`
	RelationalOp    string   `json:"relationalOperation"`
	CorrectResponse []string `json:"correctResponse"`
	RelatedTo       int      `json:"relatedTo"`
}

type QuestionResponseSchema struct {
	QuestionText    string   `json:"questionText"`
	QuestionType    string   `json:"questionType"`
	SectionID       int      `json:"sectionId"`
	Options         []string `json:"options"`
	RelationalOp    string   `json:"relationalOperation"`
	CorrectResponse []string `json:"correctResponse"`
	RelatedTo       int      `json:"relatedTo"`
}

type Question struct {
	ID                  int         `orm:"column(id);auto"`
	QuestionText        string      `orm:"column(question_text)" json:"questionText"`
	QuestionType        string      `orm:"column(question_type)" json:"questionType"`
	QuestionUUID        string      `orm:"column(question_uuid)"`
	SectionID           int         `orm:"column(section_id)"`
	Options             string      `orm:"column(options);type(json)" json:"options"`
	CorrectResponse     string      `orm:"column(correct_response);type(json)" json:"correctResponse"`
	RelationalOperation string      `orm:"column(relational_operation)" json:"relatedOperation"`
	RelatedTo           int         `orm:"column(related_to)"`
	FollowUps           []*Question `orm:"reverse(many)" json:"followUps"`
}

// creates a new question in a section of a form version, new question data is added questions table
func CreateQuestion(db *sql.DB, requestBody QuestionSchema) (int64, error) {
	var sqlResponse sql.Result
	var err error
	if requestBody.RelatedTo != 0 {
		sqlResponse, err = CreateChildQuestion(db, requestBody)
	} else {
		sqlResponse, err = CreateParentQuestion(db, requestBody)
	}
	if sqlResponse == nil {
		return -1, err
	} else if lastEnteredID, err := sqlResponse.LastInsertId(); err == nil {
		return lastEnteredID, nil
	} else {
		return -1, err
	}
}

// This function will update all the fields provided based on the question id
func EditQuestion(db *sql.DB, requestBody QuestionSchema, id int) error {
	var err error
	if requestBody.RelatedTo != 0 {
		err = UpdateChildQuestion(db, requestBody, id)
	} else {
		err = UpdateParentQuestion(db, requestBody, id)
	}

	return err
}

// This function is to create the child Question whose parent question id is present in the related to field
// y

var parentQuestionColumns = []string{
	"question_text",
	"question_type",
	"question_uuid",
	"section_id",
	"options",
	"relational_operation",
}

var childQuestionColumns = []string{
	"question_text",
	"question_type",
	"question_uuid",
	"section_id",
	"options",
	"relational_operation",
	"correct_response",
	"related_to",
}

// This function is to create the child Question whose parent question id is present in the related to field
func CreateChildQuestion(db *sql.DB, requestBody QuestionSchema) (sql.Result, error) {

	optionsString, correctResponseString, err := helpers.ConvertSliceToStrFormat(requestBody.Options, requestBody.CorrectResponse)

	if err != nil {
		return nil, err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return nil, err
	} else {
		qb.InsertInto("questions", childQuestionColumns...).Values("?,?,?,?,?,?,?,?")
		sql := qb.String()
		o, err := orm.NewOrmWithDB("mysql", "default", db)

		if err != nil {
			return nil, err
		}
		sqlResponse, err := o.Raw(sql,
			requestBody.QuestionText,
			requestBody.QuestionType,
			helpers.GenerateUUID(),
			strconv.Itoa(requestBody.SectionID),
			optionsString,
			requestBody.RelationalOp,
			correctResponseString,
			requestBody.RelatedTo).Exec()
		return sqlResponse, err
	}
}

// This function is to create the parent question, it will not have related_to, correct_response and relational_operator fields
func CreateParentQuestion(db *sql.DB, requestBody QuestionSchema) (sql.Result, error) {
	optionsString, _, err := helpers.ConvertSliceToStrFormat(requestBody.Options, requestBody.CorrectResponse)

	if err != nil {
		return nil, err
	}
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return nil, err
	} else {
		qb.InsertInto("questions", parentQuestionColumns...).Values("?,?,?,?,?,?")
		sql := qb.String()
		o, err := orm.NewOrmWithDB("mysql", fmt.Sprintf("%v", rand.Intn(1000)+1000), db)
		if err != nil {
			return nil, err
		}
		sqlResponse, err := o.Raw(
			sql,
			requestBody.QuestionText,
			requestBody.QuestionType,
			helpers.GenerateUUID(),
			strconv.Itoa(requestBody.SectionID),
			optionsString,
			requestBody.RelationalOp).Exec()
		return sqlResponse, err
	}
}

// This function is to update the child Question whose parent question id is present in the related to field
func UpdateChildQuestion(db *sql.DB, requestBody QuestionSchema, id int) error {
	optionsString, correctResponseString, err := helpers.ConvertSliceToStrFormat(requestBody.Options, requestBody.CorrectResponse)

	if err != nil {
		return err
	}
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		o, err := orm.NewOrmWithDB("mysql", "default", db)
		if err != nil {
			return err
		}
		qb.Update("questions").Set(
			"question_text = ?",
			"question_type = ?",
			"section_id = ?",
			"options = ?",
			"relational_operation = ?",
			"correct_response = ?",
			"related_to = ?",
		).Where("id = ?")
		sql := qb.String()
		_, err = o.Raw(sql,
			requestBody.QuestionText,
			requestBody.QuestionType,
			requestBody.SectionID,
			optionsString,
			requestBody.RelationalOp,
			correctResponseString,
			requestBody.RelatedTo,
			id).Exec()
		return err
	}
}

// This function is to update the parent question which will not have related_to field
func UpdateParentQuestion(db *sql.DB, requestBody QuestionSchema, id int) error {
	optionsString, _, err := helpers.ConvertSliceToStrFormat(requestBody.Options, requestBody.CorrectResponse)
	if err != nil {
		return err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {

		o, err := orm.NewOrmWithDB("mysql", "default", db)

		if err != nil {
			return err
		}

		qb.Update("questions").Set(
			"question_text = ?",
			"question_type = ?",
			"section_id = ?",
			"options = ?",
			"relational_operation = ?",
		).Where("id = ?")
		sql := qb.String()
		_, err = o.Raw(sql,
			requestBody.QuestionText,
			requestBody.QuestionType,
			requestBody.SectionID,
			optionsString,
			requestBody.RelationalOp,
			id).Exec()
		return err
	}
}

// retrieves the parent questions for a given page number, and also retrieves the child questions for each parent question
func GetQuestions(db *sql.DB, sectionID, page, size int) ([]Question, []Question, error) {

	var parentQuestions, childQuestions []Question

	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return parentQuestions, childQuestions, err
	}

	offset := (page - 1) * size

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return parentQuestions, childQuestions, err
	} else {

		qb.Select("*").
			From("questions").
			Where("section_id=?").
			And("row_status=1").
			And("related_to IS NULL").
			Limit(size).
			Offset(offset)

		sql := qb.String()

		if _, err = o.Raw(sql, sectionID).QueryRows(&parentQuestions); err != nil {
			return parentQuestions, childQuestions, err
		}

		qb.Select("*").
			From("questions").
			Where("row_status=1").
			And("related_to IN (SELECT id FROM questions WHERE section_id=? AND row_status=1 AND related_to IS NULL)")
		sql = qb.String()

		if _, err = o.Raw(sql, sectionID).QueryRows(&childQuestions); err != nil {
			return parentQuestions, childQuestions, err
		}
		return parentQuestions, childQuestions, err
	}
}

// deletes an existing question from the questions table
func DeleteQuestion(db *sql.DB, questionID int) error {
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		qb.Update("questions").Set("row_status=0").Where("id=? OR related_to=?")
		sql := qb.String()
		id := strconv.Itoa(questionID)
		if _, err := o.Raw(sql, id, id).Exec(); err != nil {
			return err
		}
	}
	return nil
}

// Checks wether the question exists in the particular section or not
func IsQuestionExistInSection(db *sql.DB, questionID int, sectionID int) (int, error) {
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return -1, err
	}

	var count int
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("COUNT(*)").From("questions").Where("id=? AND section_id=?")
		sql := qb.String()
		if err := o.Raw(sql, strconv.Itoa(questionID), strconv.Itoa(sectionID)).QueryRow(&count); err != nil {
			return -1, err
		}
	}
	return count, nil
}

// Checks wether the same parent question exists or not
func IsParentQuestionExist(db *sql.DB, questionText string, id int, sectionID int) (int, error) {
	o, _ := orm.NewOrmWithDB("mysql", "default", db)
	var count int
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("COUNT(*)").
			From("questions").
			Where("question_text=? AND related_to IS NULL").
			And("id != ? AND section_id = ?")
		sql := qb.String()
		if err := o.Raw(sql, questionText, id, sectionID).QueryRow(&count); err != nil {
			return -1, err
		}
		return count, nil
	}
}

// Gets the question texts of all the child questions of given ID
func GetChildQuestions(db *sql.DB, parentID int, id int) ([]string, error) {
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return []string{}, err
	}

	var questionTexts []string
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return []string{}, err
	} else {
		qb.Select("question_text").From("questions").Where("related_to=?").And("id != (?)")
		sql := qb.String()

		if _, err = o.Raw(sql, parentID, id).QueryRows(&questionTexts); err != nil {
			return []string{}, err
		}
		return questionTexts, nil
	}
}

// check if the question is related to a child question
func IsItRelatedToChildQuestion(db *sql.DB, parentID int) error {
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		var relatedTo int
		qb.Select("related_to").From("questions").Where("id=?")
		sql := qb.String()

		o, err := orm.NewOrmWithDB("mysql", "default", db)

		if err != nil {
			return err
		}

		if err = o.Raw(sql, parentID).QueryRow(&relatedTo); err != nil {
			return err
		}
		if relatedTo != 0 {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "Child question cannot contain other child questions")
		}
		return nil
	}
}

// check if parent contains maximum children ( maximum number of children's is 3)
func DoesParentContainMaximumChildren(db *sql.DB, parentID int) error {
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		var childrenCount int
		qb.Select("COUNT(*)").From("questions").Where("related_to=?")
		sql := qb.String()
		o, err := orm.NewOrmWithDB("mysql", "default", db)

		if err != nil {
			return err
		}
		if err = o.Raw(sql, parentID).QueryRow(&childrenCount); err != nil {
			return err
		}
		if childrenCount == 3 {
			return errors.NewHTTPError(nil, http.StatusBadRequest, "Parent question contains maximum number of children, can not create another child question")
		}
		return nil
	}
}

// retrieves the questionText of a given question ID
func FetchQuestionText(db *sql.DB, questionID int) (string, error) {
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return "", err
	}
	var questionText string
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return "", err
	} else {
		qb.Select("question_text").From("questions").Where("id=?")
		sql := qb.String()
		if err := o.Raw(sql, strconv.Itoa(questionID)).QueryRow(&questionText); err != nil {
			return "", err
		} else {
			return questionText, nil
		}
	}
}

// retrieves the questionType and options of a given question ID
func FetchQuestionDetails(db *sql.DB, questionID int) (string, string, error) {
	var questionType string
	var optionsString string
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return "", "", err
	} else {
		qb.Select("question_type", "options").From("questions").Where("id=?")
		sql := qb.String()
		o, err := orm.NewOrmWithDB("mysql", "default", db)

		if err != nil {
			return "", "", err
		}

		if err := o.Raw(sql, questionID).QueryRow(&questionType, &optionsString); err != nil {
			return "", "", err
		}
		return questionType, optionsString, nil
	}
}

// get the count of total questions present and active in questions table for a given section ID
func GetTotalNumberOfQuestions(db *sql.DB, sectionID int) (int, error) {

	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return -1, err
	}
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("COUNT(*)").From("questions").Where("section_id=? AND related_to IS NULL AND row_status=1")
		sql := qb.String()
		var count int
		if err := o.Raw(sql, sectionID).QueryRow(&count); err != nil {
			return -1, err
		}
		return count, nil
	}
}
