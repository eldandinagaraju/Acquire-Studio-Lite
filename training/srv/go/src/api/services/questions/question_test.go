package questions

import (
	"api/models"
	"encoding/json"
	"fmt"
	"strconv"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/beego/beego/v2/client/orm"
	"github.com/stretchr/testify/assert"
)

func TestCreateQuestion(t *testing.T) {

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
		name: "should pass while creating child question",

		vars: vars{
			requestBody: models.QuestionSchema{
				QuestionText:    "what are your hobbies ?",
				QuestionType:    "MULTI_SELECT",
				SectionID:       9,
				Options:         []string{"eating", "drinking", "coding"},
				CorrectResponse: []string{"vasu"},
				RelatedTo:       1,
			},
			id: -1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			row := mock.NewRows([]string{"related_to"}).AddRow(0)
			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.RelatedTo).WillReturnRows(row)

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.RelatedTo).WillReturnRows(sqlmock.NewRows([]string{"count"}).AddRow(0))

			row = mock.NewRows([]string{"question_text"}).AddRow("some question")
			mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.requestBody.RelatedTo)).WillReturnRows(row)

			rows := mock.NewRows([]string{"question_text"}).AddRow("some question")
			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.RelatedTo, v.id).WillReturnRows(rows)

			expectedQuery = "SELECT .+ FROM sections"
			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnRows(sqlmock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.requestBody.RelatedTo), strconv.Itoa(v.requestBody.SectionID)).WillReturnRows(sqlmock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.RelatedTo).WillReturnRows(sqlmock.NewRows([]string{"question_type", "options"}).AddRow("TEXT_TYPE", nil))

			expectedQuery = "INSERT INTO questions"
			mock.ExpectExec(expectedQuery).WillReturnResult(sqlmock.NewResult(1, 1))

		},
		want: QuestionResponseSchema{Id: 1},

		hasErr: false,
	},
		{
			name: "should return error while we try to add child question to a child question",
			vars: vars{
				requestBody: models.QuestionSchema{
					RelatedTo: 2,
				},
				id: -1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.RelatedTo).WillReturnRows(mock.NewRows([]string{"related_to"}).AddRow(1))
			},
			hasErr: true,
			err:    "Child question cannot contain other child questions",
		},
		{
			name: "should return error when we have max number of child questions to the parent question",
			vars: vars{
				requestBody: models.QuestionSchema{
					RelatedTo: 3,
				}, id: -1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.RelatedTo).WillReturnRows(mock.NewRows([]string{"related_to"}).AddRow(0))

				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.RelatedTo).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(3))

			},
			hasErr: true,
			err:    "Parent question contains maximum number of children, can not create another child question",
		},
		{
			name: "should return error invalid question text",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText: "hi",
				}, id: -1,
			},
			hasErr: true,
			err:    "Invalid Question Text",
		},
		{
			name: "should return error while calling create question of model function",
			vars: vars{
				requestBody: models.QuestionSchema{
					QuestionText: "Question ?",
					QuestionType: "TEXT_TYPE",
					SectionID:    1,
				},
				id: -1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.SectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))

				expectedQuery = "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				expectedQuery = "INSERT INTO questions"
				mock.ExpectExec(expectedQuery).WillReturnError(fmt.Errorf("some error"))

			},
			hasErr: true,
			err:    "some error",
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {

			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("Error occured while creating stub database connection : %v", err)
			}

			if tCase.mock != nil {
				tCase.mock(mock, tCase.vars)
			}

			requestBody, err := json.Marshal(tCase.vars.requestBody)

			if err != nil {
				t.Errorf("marshalling error : %v", err)
			}
			got, err := CreateQuestion(db, requestBody)

			if tCase.hasErr {
				assert.Equal(tt, err.Error(), tCase.err)
			} else if err != nil {
				t.Errorf("This error should not be returned , error returned is , error : %v", err.Error())
			} else {
				assert.Equal(tt, tCase.want, got)
			}
		})
	}
}

func TestGetQuestions(t *testing.T) {

	type vars struct {
		sectionID int
		page      int
	}

	testCases := []struct {
		name   string
		vars   vars
		mock   func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we pass valid setioon id",
		vars: vars{
			sectionID: 1,
			page:      1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM sections"
			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(10))

			row1 := mock.NewRows([]string{"id", "question_text", "question_type", "question_uuid", "relational_operation", "options", "correct_response", "related_to"}).AddRow(1, "Question?", "TEXT_TYPE", "uniqueID", "=", nil, nil, nil)

			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(row1)

			correctResponse := []string{"yes"}
			convertedCorrectResponse, _ := json.Marshal(correctResponse)

			row2 := mock.NewRows([]string{"id", "question_text", "question_type", "question_uuid", "relational_operation", "options", "correct_response", "related_to"}).AddRow(2, "childQuestion?", "TEXT_TYPE", "uniqueID2", "=", nil, convertedCorrectResponse, 1)
			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(row2)

		},
		hasErr: false,
	},
		{
			name: "Should return error while passing invalid section id",
			vars: vars{
				sectionID: 2,
				page:      2,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
			},
			hasErr: true,
			err:    "Invalid Section ID",
		}, {
			name: " will return error with error no rows while fetching the total number of questions",
			vars: vars{
				sectionID: 1,
				page:      1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				expectedQuery = "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		}, {
			name: "should return error invalid page number",
			vars: vars{
				sectionID: 1,
				page:      0,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				expectedQuery = "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(10))
			},
			hasErr: true,
			err:    "Invalid Page Number",
		}, {
			name: "will return error with error no rows",
			vars: vars{
				sectionID: 1,
				page:      1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				expectedQueryQuestions := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQueryQuestions).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(10))

				mock.ExpectQuery(expectedQueryQuestions).WithArgs(v.sectionID).WillReturnError(orm.ErrNoRows)
			},
			hasErr: true,
			err:    orm.ErrNoRows.Error(),
		}, {
			name: "will return sql error while checking whether the section id exists or not",
			vars: vars{
				sectionID: 1,
				page:      1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		},
	}

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
			defer db.Close()

			_, err = GetQuestions(db, tCase.vars.sectionID, tCase.vars.page)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be returned , error returned is : %v", err)
			}

		})
	}
}

func TestEditQuestion(t *testing.T) {

	type vars struct {
		id      int
		reqBody models.QuestionSchema
	}

	testCases := []struct {
		name   string
		vars   vars
		mock   func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we pass all the required fields in the request body",
		vars: vars{
			id: 1,
			reqBody: models.QuestionSchema{
				QuestionText: "Question?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
			},
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.reqBody.QuestionText, v.reqBody.SectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))

			expectedQuery = "SELECT .+ FROM sections"
			mock.ExpectQuery(expectedQuery).WithArgs(v.reqBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "UPDATE questions"
			mock.ExpectExec(expectedQuery).WithArgs(v.reqBody.QuestionText, v.reqBody.QuestionType, v.reqBody.SectionID, nil, "=", v.id).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should return error question not found",
		vars: vars{
			id:      1,
			reqBody: models.QuestionSchema{},
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
		},
		hasErr: true,
		err:    "Question not found.",
	}, {
		name: "should return error cannot have same parent and child questions",
		vars: vars{
			id: 1,
			reqBody: models.QuestionSchema{
				QuestionText: "Question?",
				RelatedTo:    2,
			}},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.reqBody.RelatedTo).WillReturnRows(mock.NewRows([]string{"related_to"}).AddRow(0))

			mock.ExpectQuery(expectedQuery).WithArgs(v.reqBody.RelatedTo).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.reqBody.RelatedTo)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow(v.reqBody.QuestionText))

		},
		hasErr: true,
		err:    "Cannot have same parent and child question",
	},
		{
			name: "will return error while update query execution",
			vars: vars{
				id: 1,
				reqBody: models.QuestionSchema{
					QuestionText: "Question?",
					QuestionType: "TEXT_TYPE",
					SectionID:    1,
				}},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				mock.ExpectQuery(expectedQuery).WithArgs(v.reqBody.QuestionText, v.reqBody.SectionID, v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))

				expectedQuery = "SELECT .+ FROM sections"
				mock.ExpectQuery(expectedQuery).WithArgs(v.reqBody.SectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				expectedQuery = "UPDATE questions"
				mock.ExpectExec(expectedQuery).WithArgs(v.reqBody.QuestionText, v.reqBody.QuestionType, v.reqBody.SectionID, nil, "=", v.id).WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		},
	}

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
			defer db.Close()

			requestBody, err := json.Marshal(tCase.vars.reqBody)

			if err != nil {
				t.Errorf("marshalling error : %v", err)
			}

			_, err = EditQuestion(db, requestBody, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be returned , error returned is : %v", err)
			}

		})
	}
}

func TestDeleteQuestion(t *testing.T) {

	type vars struct {
		qID int
	}
	testCases := []struct {
		name   string
		vars   vars
		mock   func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we pass valid question id",
		vars: vars{
			qID: 1,
		},
		mock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.qID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "UPDATE questions"
			mock.ExpectExec(expectedQuery).WithArgs(strconv.Itoa(v.qID), strconv.Itoa(v.qID)).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	},
		{
			name: "should return question not found error",
			vars: vars{
				qID: 1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.qID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
			},
			hasErr: true,
			err:    "Question not found.",
		}, {
			name: "should return error while deleting",
			vars: vars{
				qID: 1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expectedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expectedQuery).WithArgs(v.qID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

				expectedQuery = "UPDATE questions"
				mock.ExpectExec(expectedQuery).WithArgs(strconv.Itoa(v.qID), strconv.Itoa(v.qID)).WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		},
		{
			name: "will return sql error while checking whether the section id exists or not",
			vars: vars{
				qID: 1,
			},
			mock: func(mock sqlmock.Sqlmock, v vars) {
				expecedQuery := "SELECT .+ FROM questions"
				mock.ExpectQuery(expecedQuery).WithArgs(v.qID).WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occured while creating a stub database connection : %v", err)
			}

			if tCase.mock != nil {
				tCase.mock(mock, tCase.vars)
			}

			err = DeleteQuestion(db, tCase.vars.qID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				t.Errorf("this error should not be returned here , the error returned is error : %v", err)
			}

		})
	}
}
