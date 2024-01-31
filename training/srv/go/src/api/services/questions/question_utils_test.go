package questions

import (
	"api/models"
	"encoding/json"
	"fmt"
	"os"
	"strconv"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/beego/beego/v2/client/orm"
	"github.com/stretchr/testify/assert"
)

func TestValidateQuestionIDs(t *testing.T) {
	type vars struct {
		questionID int
		parentID   int
	}
	testCases := []struct {
		name   string
		vars   vars
		mock   func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while passing valid parent and questin IDs",
		vars: vars{
			parentID:   1,
			questionID: 2,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnRows(mock.NewRows([]string{"related_to"}).AddRow(0))

			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))
		},
		hasErr: false,
	}, {
		name: "will return with error question not found",
		vars: vars{
			questionID: 1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
		},
		hasErr: true,
		err:    "Question not found.",
	}, {
		name: "will return error while cheking whether the id is active or not",
		vars: vars{
			questionID: 1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
		},
		hasErr: true,
		err:    "Cannot update this Question.",
	}, {
		name: "should return error child question cannot have another child questions",
		vars: vars{
			questionID: 2,
			parentID:   1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(1).WillReturnRows(mock.NewRows([]string{"related_to"}).AddRow(v.parentID))

		},
		hasErr: true,
		err:    "Child question cannot contain other child questions",
	}, {
		name: "should return error at max child questions constraint",
		vars: vars{
			parentID:   1,
			questionID: 2,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {

			expectedQuery := "SELECT .+ FROM questions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnRows(mock.NewRows([]string{"related_to"}).AddRow(0))

			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(3))
		},
		hasErr: true,
		err:    "Parent question contains maximum number of children, can not create another child question",
	}, {
		name: "will return sql error while checking whether the question id exists or not",
		vars: vars{
			questionID: 1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "will return sql error while checking whether the question id active or not",
		vars: vars{
			questionID: 1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {

			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("An Unknown error occured while creating a stub database connection ")
			}

			defer db.Close()

			if tCase.mock != nil {
				tCase.mock(mock, tCase.vars)
			}

			err = ValidateQuestionIDs(db, tCase.vars.questionID, tCase.vars.parentID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be returned , error returned is : %v", err)
			}

		})
	}

}

func TestValidateQuestionFields(t *testing.T) {

	type vars struct {
		requestBody models.QuestionSchema
		id          int
	}

	testCases := []struct {
		name   string
		mock   func(mock sqlmock.Sqlmock, v vars)
		vars   vars
		want   QuestionResponseSchema
		hasErr bool
		err    string
	}{{
		name: "should pass when we call with correct request body",
		vars: vars{
			requestBody: models.QuestionSchema{
				QuestionText: "how are you?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
			},
			id: 1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {

			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.SectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))

			expectedQuery = "SELECT .+ FROM sections"
			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))
		},
		hasErr: false,
	}, {
		name: "should pass when we call the function with all the fields",
		vars: vars{
			requestBody: models.QuestionSchema{
				QuestionText:    "Are you into sports?",
				QuestionType:    "TEXT_TYPE",
				SectionID:       1,
				RelatedTo:       2,
				CorrectResponse: []string{"yes"},
				RelationalOp:    "=",
			},
			id: 3,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQueryQuestions := "SELECT .+ FROM questions"
			expectedQuerySections := "SELECT .+ FROM sections"

			mock.ExpectQuery(expectedQueryQuestions).WithArgs(strconv.Itoa(v.requestBody.RelatedTo)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("some question"))

			mock.ExpectQuery(expectedQueryQuestions).WithArgs(v.requestBody.RelatedTo, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("child Question?"))

			mock.ExpectQuery(expectedQuerySections).WithArgs(v.requestBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQueryQuestions).WithArgs(strconv.Itoa(v.requestBody.RelatedTo), strconv.Itoa(v.requestBody.SectionID)).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQueryQuestions).WithArgs(v.requestBody.RelatedTo).WillReturnRows(mock.NewRows([]string{"question_type", "options"}).AddRow("TEXT_TYPE", nil))
		},
	}, {
		name: "should fail when we send invalid question text",
		vars: vars{
			requestBody: models.QuestionSchema{
				QuestionText: "@@",
			},
			id: 4,
		},
		hasErr: true,
		err:    "Invalid Question Text",
	},
		{
			name: "should fail when we send invalid section ID",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText: "Question 1?",
					QuestionType: "TEXT_TYPE",
					SectionID:    1,
				},
				id: 4,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.SectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))

				expectedQuery = "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))

			},
			hasErr: true,
			err:    "Invalid Section ID",
		},
		{
			name: "should return error parent and child questions exist in same section",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText:    "Question?",
					QuestionType:    "TEXT_TYPE",
					SectionID:       1,
					RelatedTo:       1,
					RelationalOp:    "=",
					CorrectResponse: []string{"yes"},
				},
				id: 10,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.requestBody.RelatedTo)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Parent Question?"))

				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.RelatedTo, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Child Question?"))

				expectedQuery = "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				expectedQuery = "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.requestBody.RelatedTo), strconv.Itoa(v.requestBody.SectionID)).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
			},
			hasErr: true,
			err:    "Parent and Child Questions should Exist in the same section",
		},
		{
			name: "should return error correct response should be empty",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText:    "Question?",
					QuestionType:    "TEXT_TYPE",
					SectionID:       1,
					CorrectResponse: []string{"yes"},
				},
				id: 4,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.SectionID, v.id).WillReturnRows(mock.NewRows([]string{"conut"}).AddRow(0))

				expectedQuery = "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))
			},
			hasErr: true,
			err:    "Correct Response Should be empty",
		}, {
			name: "will return error while validating the question type",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText: "Question?",
					QuestionType: "INVALID_TYPE",
					SectionID:    1,
				},
				id: 1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.SectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
			},
			hasErr: true,
			err:    "Invalid Question Type",
		}, {
			name: "will return sql error while checking whether the section id exists or not",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText: "Question?",
					QuestionType: "TEXT_TYPE",
					SectionID:    1,
				},
				id: 1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.SectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))

				expectedQuery = "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		}, {
			name: "will return sql error while checking whether the question exists in the same section or not",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText: "Question?",
					QuestionType: "TEXT_TYPE",
					SectionID:    1,
					RelatedTo:    2,
				},
				id: 1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQueryQuestions := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQueryQuestions).WithArgs(strconv.Itoa(v.requestBody.RelatedTo)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Parent Question?"))

				mock.ExpectQuery(expectedQueryQuestions).WithArgs(v.requestBody.RelatedTo, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Child Question?"))

				expectedQuery := "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				mock.ExpectQuery(expectedQueryQuestions).WithArgs(strconv.Itoa(v.requestBody.RelatedTo), strconv.Itoa(v.requestBody.SectionID)).WillReturnError(fmt.Errorf("some error"))

			},
			hasErr: true,
			err:    "some error",
		}, {
			name: "will return error while checking the correct response",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText: "Question?",
					QuestionType: "TEXT_TYPE",
					SectionID:    1,
					RelatedTo:    2,
				},
				id: 1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQueryQuestions := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQueryQuestions).WithArgs(strconv.Itoa(v.requestBody.RelatedTo)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Parent Question?"))

				mock.ExpectQuery(expectedQueryQuestions).WithArgs(v.requestBody.RelatedTo, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Child Question?"))

				expectedQuery := "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				mock.ExpectQuery(expectedQueryQuestions).WithArgs(strconv.Itoa(v.requestBody.RelatedTo), strconv.Itoa(v.requestBody.SectionID)).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			},
			hasErr: true,
			err:    "Correct Response cannot  be empty",
		}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {

			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("Error occured while creating a stub database connection : %v", err)
			}

			if tCase.mock != nil {
				tCase.mock(mock, tCase.vars)
			}

			err = ValidateQuestionFields(db, tCase.vars.requestBody, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be returned here , but the error we got is : %v", err)
			}

		})
	}

}

func TestValidateQuestionText(t *testing.T) {

	type vars struct {
		questionText string
		parentID     int
		id           int
		sectionID    int
	}

	testCases := []struct {
		name   string
		vars   vars
		mock   func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while sending the parent id 0",
		vars: vars{
			questionText: "Question?",
			parentID:     0,
			id:           1,
			sectionID:    2,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.questionText, v.sectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
		},
		hasErr: false,
	}, {
		name: "should pass while sending the parent id",
		vars: vars{
			questionText: "Question?",
			parentID:     1,
			id:           2,
			sectionID:    3,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.parentID)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("ParentQuestion?"))

			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("childQuestion?"))
		},
		hasErr: false,
	}, {
		name: "should return error invalid question text",
		vars: vars{
			questionText: "@@",
		},
		hasErr: true,
		err:    "Invalid Question Text",
	},
		{
			name: "should return error invalid question length error",
			vars: vars{
				questionText: "Question?",
				parentID:     1,
				id:           2,
				sectionID:    3,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.parentID)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Question?"))
			},
			hasErr: true,
			err:    "Cannot have same parent and child question",
		},
		{
			name: "should return error while validting child questions",
			vars: vars{
				questionText: "Question?",
				parentID:     1,
				id:           2,
				sectionID:    3,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.parentID)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Question Parent?"))

				mock.ExpectQuery(expectedQuery).WithArgs(v.parentID, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Question?"))
			},
			hasErr: true,
			err:    "This child question already exists",
		},
		{

			name: "should return error this question already exists",
			vars: vars{
				questionText: "Question?",
				parentID:     0,
				id:           2,
				sectionID:    3,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.questionText, v.sectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))
			},
			hasErr: true,
			err:    "This Question Already Exists",
		},
		{
			name: "will return sql error while trying to fetch the question text",
			vars: vars{
				questionText: "Question?",
				parentID:     1,
				id:           2,
				sectionID:    3,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"

				mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.parentID)).WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		},
		{
			name: "will return sql error while checking whether the same parent question already exists or not",
			vars: vars{
				questionText: "Question?",
				id:           1,
				sectionID:    2,
				parentID:     0,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.questionText, v.sectionID, v.id).WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {

			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("Error occured while creating stub database connection %v", err)
			}

			if tCase.mock != nil {
				tCase.mock(mock, tCase.vars)
			}

			err = ValidateQuestionText(db, tCase.vars.questionText, tCase.vars.parentID, tCase.vars.sectionID, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be returned here , but the error we got is : %v", err)
			}

		})
	}
}

func TestValidateChildQuestions(t *testing.T) {

	type vars struct {
		questionText string
		parentID     int
		id           int
	}

	testCases := []struct {
		name   string
		vars   vars
		mock   func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass",
		vars: vars{
			questionText: "Question?",
			parentID:     1,
			id:           2,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("child Question"))
		},
		hasErr: false,
	},
		{
			name: "should return error while we pass same question text for the parent and child questions",
			vars: vars{
				questionText: "Question?",
				parentID:     1,
				id:           2,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.parentID, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow(v.questionText))
			},
			hasErr: true,
			err:    "This child question already exists",
		},
		{
			name: "should return error no rows error ",
			vars: vars{
				questionText: "Question?",
				parentID:     1,
				id:           2,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.parentID, v.id).WillReturnError(orm.ErrNoRows)
			},
			hasErr: true,
			err:    orm.ErrNoRows.Error(),
		}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("Error occured while creating the database stub connection : %v", err)
			}

			if tCase.mock != nil {
				tCase.mock(mock, tCase.vars)
			}

			err = ValidateChildQuestions(db, tCase.vars.parentID, tCase.vars.questionText, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("This error should not be returned here , the error returned is : %v", err)
			}
		})
	}
}

func TestValidateQuestionType(t *testing.T) {
	type vars struct {
		qType   string
		options []string
	}

	testCases := []struct {
		name   string
		vars   vars
		hasErr bool
		err    string
	}{{
		name: "should pass when we send valid question type",
		vars: vars{
			qType:   "SINGLE_SELECT",
			options: []string{"yes", "no"},
		},
		hasErr: false,
	}, {
		name: "should return error options should be empty",
		vars: vars{
			qType:   "TEXT_TYPE",
			options: []string{"yes", "no"},
		},
		hasErr: true,
		err:    "Options should be empty",
	}, {
		name: "should return error options should not be empty",
		vars: vars{
			qType:   "MULTI_SELECT",
			options: []string{},
		},
		hasErr: true,
		err:    "Options should not be empty",
	}, {
		name: "should return error invalid question type",
		vars: vars{
			qType: "INVALID_TYPE",
		},
		hasErr: true,
		err:    "Invalid Question Type",
	}, {
		name: "should return options should not be empty error for single select type",
		vars: vars{
			qType:   "SINGLE_SELECT",
			options: []string{},
		},
		hasErr: true,
		err:    "Options should not be empty",
	}, {
		name: "should return options should  be empty error for integer type",
		vars: vars{
			qType:   "INT_TYPE",
			options: []string{"option1"},
		},
		hasErr: true,
		err:    "Options should be empty",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			err := ValidateQuestionType(tCase.vars.qType, tCase.vars.options)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				t.Errorf("This error should not be returned here , the error returned is : %v", err)
			}
		})
	}
}

func TestValidaeteRelationalOperator(t *testing.T) {

	type vars struct {
		relationalOP string
		qType        string
	}
	testCases := []struct {
		name   string
		vars   vars
		hasErr bool
		err    string
	}{{
		name: "should pass when we send valid arguments",
		vars: vars{
			relationalOP: ">",
			qType:        "INT_TYPE",
		},
		hasErr: false,
	}, {
		name: "should return error invalid relational operator",
		vars: vars{
			relationalOP: "*",
		},
		hasErr: true,
		err:    "Invalid Relational Operator",
	}, {
		name: "should return error",
		vars: vars{
			relationalOP: ">",
			qType:        "TEXT_TYPE",
		},
		hasErr: true,
		err:    "Invalid Relational Operator for this type questions",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			err := ValidateRelationalOperator(tCase.vars.relationalOP, tCase.vars.qType)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				t.Errorf("This error should not be returned here , the error returned is : %v", err)
			}
		})
	}
}

func TestValidateCorrectResponse(t *testing.T) {

	type vars struct {
		relationalOperator string
		id                 int
		correctResponse    []string
	}

	testCases := []struct {
		name   string
		vars   vars
		mock   func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass when we send valid correct response",
		vars: vars{
			relationalOperator: "=",
			id:                 1,
			correctResponse:    []string{"yes"},
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			options := []string{"yes", "no"}
			convertedoptions, _ := json.Marshal(options)

			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"question_type", "options"}).AddRow("SINGLE_SELECT", convertedoptions))
		},
		hasErr: false,
	}, {
		name: "should return the error correct response cant be empty",
		vars: vars{
			relationalOperator: "=",
			id:                 1,
		},
		hasErr: true,
		err:    "Correct Response cannot  be empty",
	}, {
		name: " should return error no rows error",
		vars: vars{
			id:              1,
			correctResponse: []string{"yes", "no"},
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnError(orm.ErrNoRows)
		},
		hasErr: true,
		err:    orm.ErrNoRows.Error(),
	},
		{
			name: " should return error while checking the correct response",
			vars: vars{
				id:              1,
				correctResponse: []string{"yes", "no"},
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {

				options := []string{"yes", "no"}
				convertedOptions, _ := json.Marshal(options)
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"question_type", "options"}).AddRow("SINGLE_SELECT", convertedOptions))
			},
			hasErr: true,
			err:    "Correct Response should have only one option",
		},
		{
			name: "should return error of invalid correct response",
			vars: vars{
				relationalOperator: "=",
				id:                 1,
				correctResponse:    []string{"yes"},
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				options := []string{"apple", "mango"}
				convertedOptions, _ := json.Marshal(options)
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"question_type", "options"}).AddRow("SINGLE_SELECT", convertedOptions))
			},
			hasErr: true,
			err:    "Invalid Correct Response",
		},
		{
			name: "will return error while passing invalid relational operator",
			vars: vars{
				relationalOperator: "invalid",
				id:                 1,
				correctResponse:    []string{"yes", "no"},
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM question"

				options := []string{"yes", "no"}
				convertedOptions, _ := json.Marshal(options)

				mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"question_type", "options"}).AddRow("MULTI_SELECT", convertedOptions))
			},
			hasErr: true,
			err:    "Invalid Relational Operator",
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {

			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("Error occured while creating the database stub connection : %v", err)
			}

			if tCase.mock != nil {
				tCase.mock(mock, tCase.vars)
			}

			err = ValidateCorrectResponse(db, tCase.vars.relationalOperator, tCase.vars.id, tCase.vars.correctResponse)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("This error should not be returned here , the error returned is : %v", err)
			}
		})
	}
}

func TestCheckCorrectResponse(t *testing.T) {
	type vars struct {
		qType           string
		correctResponse []string
	}

	testCases := []struct {
		name   string
		vars   vars
		hasErr bool
		err    string
	}{{
		name: "should pass whilep passing valid arguments",
		vars: vars{
			qType:           "MULTI_SELECT",
			correctResponse: []string{"yes", "no"},
		},
		hasErr: false,
	}, {
		name: "should return error  while passing invalid arguments",
		vars: vars{
			qType:           "TEXT_TYPE",
			correctResponse: []string{"yes", "no"},
		},
		hasErr: true,
		err:    "Correct Response should have only one option",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			err := checkCorrrectReponse(tCase.vars.qType, tCase.vars.correctResponse)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				t.Errorf("This error should not be returned here , the error returned is : %v", err)
			}
		})
	}
}

func TestConvertToJSON(t *testing.T) {
	type vars struct {
		question models.Question
	}

	optionsString, _ := json.Marshal([]string{"option1", "option2"})
	correctRespString, _ := json.Marshal([]string{"option1"})
	relOp := "="

	testCases := []struct {
		name   string
		vars   vars
		want   QuestionsListingSchema
		hasErr bool
		err    string
	}{{
		name: "should pass while we pass a valid quesion as the parameter",
		vars: vars{
			question: models.Question{
				ID:                  1,
				QuestionText:        "Question?",
				QuestionType:        "SINGLE_SELECT",
				SectionID:           3,
				Options:             string(optionsString),
				RelationalOperation: "=",
				RelatedTo:           2,
				CorrectResponse:     string(correctRespString),
			},
		},
		want: QuestionsListingSchema{
			ID:                  1,
			QuestionText:        "Question?",
			QuestionType:        "SINGLE_SELECT",
			Options:             []string{"option1", "option2"},
			RelationalOperation: &relOp,
			CorrectResponse:     []string{"option1"},
			ChildQuestions:      []*QuestionsListingSchema{},
		},
		hasErr: false,
	}}

	for _, tCase := range testCases {

		t.Run(tCase.name, func(tt *testing.T) {

			got, err := ConvertToJSON(tCase.vars.question)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				t.Errorf("this error should not be encountered here , the error encountered is , error : %v", err)
			} else {
				assert.Equal(tt, got, tCase.want)
			}

		})

	}
}

func TestGetQuestionResponse(t *testing.T) {

	optionsString, _ := json.Marshal([]string{"option1", "option2"})

	parentQuestion1 := QuestionsListingSchema{
		ID:              1,
		QuestionText:    "Parent Question1?",
		QuestionType:    "TEXT_TYPE",
		Options:         []string{},
		CorrectResponse: []string{},
		ChildQuestions:  []*QuestionsListingSchema{},
	}

	parentQuestion2 := QuestionsListingSchema{
		ID:              2,
		QuestionText:    "Parent Question2?",
		QuestionType:    "SINGLE_SELECT",
		Options:         []string{"option1", "option2"},
		CorrectResponse: []string{},
		ChildQuestions:  []*QuestionsListingSchema{},
	}

	type vars struct {
		parentQuestions []models.Question
		childQuestions  []models.Question
	}

	testCases := []struct {
		name   string
		vars   vars
		want   []*QuestionsListingSchema
		hasErr bool
		err    string
	}{{
		name: "should pass while passing child questions and parent questions",
		vars: vars{
			parentQuestions: []models.Question{{
				ID:           1,
				QuestionText: "Parent Question1?",
				QuestionType: "TEXT_TYPE",
				Options:      "",
				SectionID:    1,
			}, {
				ID:           2,
				QuestionText: "Parent Question2?",
				QuestionType: "SINGLE_SELECT",
				SectionID:    1,
				Options:      string(optionsString),
			}},
		},
		hasErr: false,
		want:   []*QuestionsListingSchema{&parentQuestion1, &parentQuestion2},
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			got, err := GetQuestionsResponse(tCase.vars.parentQuestions, tCase.vars.childQuestions)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				t.Errorf("this error should not be encountered here , the error encountered is , error : %v", err)
			} else {

				for i := 0; i < 2; i++ {
					assert.Equal(tt, *got[i], *tCase.want[i])
				}

			}
		})
	}
}

func TestMain(m *testing.M) {
	orm.Debug = true
	code := m.Run()
	os.Exit(code)
}
