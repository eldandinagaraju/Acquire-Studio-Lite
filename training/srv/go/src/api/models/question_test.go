package models

import (
	"encoding/json"
	"fmt"
	"strconv"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/stretchr/testify/assert"
)

func TestCreateQuestion(t *testing.T) {
	type vars struct {
		requestBody QuestionSchema
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   int64
		hasErr bool
		err    string
	}{{
		name: "should pass while creating a parent question",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "Question?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "INSERT INTO questions"

			mock.ExpectExec(expectedQuery).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		want:   int64(1),
		hasErr: false,
	}, {
		name: "should pass while creating a child question",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText:    "Question?",
				QuestionType:    "TEXT_TYPE",
				SectionID:       1,
				RelatedTo:       2,
				CorrectResponse: []string{"correct_response"},
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "INSERT INTO questions"

			mock.ExpectExec(expectedQuery).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		want:   int64(1),
		hasErr: false,
	}, {
		name: "should return sql error while we try to create a parent question",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "Question?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "INSERT INTO questions"

			mock.ExpectExec(expectedQuery).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return sql error while we try to create a parent question",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "Question?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "INSERT INTO questions"

			mock.ExpectExec(expectedQuery).WillReturnResult(sqlmock.NewErrorResult(fmt.Errorf("some error")))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("An error occurred while creating stub database connection : %v", err)
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			got, err := CreateQuestion(db, tCase.vars.requestBody)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				t.Errorf("This error should not be returned here the error returned is : %v ", err)
			} else {
				assert.Equal(tt, tCase.want, got, tCase)
			}
		})
	}

}

func TestEditQuestion(t *testing.T) {

	correctResponseString, _ := json.Marshal([]string{"correct_response"})
	type vars struct {
		requestBody QuestionSchema
		id          int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   int64
		hasErr bool
		err    string
	}{{
		name: "should pass while updating the parent question",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "Question?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
				RelationalOp: "=",
			},
			id: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"

			mock.ExpectExec(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.QuestionType, v.requestBody.SectionID, nil, v.requestBody.RelationalOp, v.id).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should pass while updating the child question",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText:    "Question?",
				QuestionType:    "TEXT_TYPE",
				SectionID:       1,
				RelationalOp:    "=",
				RelatedTo:       2,
				CorrectResponse: []string{"correct_response"},
			},
			id: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"

			mock.ExpectExec(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.QuestionType, v.requestBody.SectionID, nil, v.requestBody.RelationalOp, string(correctResponseString), v.requestBody.RelatedTo, v.id).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should return sql error while we try to create a parent question",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "Question?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"

			mock.ExpectExec(expectedQuery).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("An error occurred while creating stub database connection : %v", err)
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			err = EditQuestion(db, tCase.vars.requestBody, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("This error should not be returned here the error returned is : %v ", err)
			}
		})
	}
}

func TestCreateChildQuestion(t *testing.T) {
	type vars struct {
		requestBody QuestionSchema
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we send valid arguments request body",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText:    "child question?",
				QuestionType:    "TEXT_TYPE",
				SectionID:       1,
				RelatedTo:       2,
				CorrectResponse: []string{"option 1"},
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "INSERT INTO questions"
			mock.ExpectExec(expectedQuery).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should return sql error while trying to add the child question . ",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText:    "Question?",
				QuestionType:    "SINGLE_SELECT",
				SectionID:       1,
				Options:         []string{"option 1", "option 2"},
				RelatedTo:       2,
				CorrectResponse: []string{"correct_response"},
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "INSERT INTO questions"
			mock.ExpectExec(expectedQuery).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			_, err = CreateChildQuestion(db, tCase.vars.requestBody)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			}
		})
	}
}

func TestCreateParentQuestion(t *testing.T) {

	type vars struct {
		requestBody QuestionSchema
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we send valid arguments for request ",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "parent question?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "INSERT INTO questions"
			mock.ExpectExec(expectedQuery).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should return sql error while trying to add the parent question . ",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "Question?",
				QuestionType: "SINGLE_SELECT",
				SectionID:    1,
				Options:      []string{"option 1", "option 2"},
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "INSERT INTO questions"
			mock.ExpectExec(expectedQuery).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			_, err = CreateParentQuestion(db, tCase.vars.requestBody)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			}
		})
	}

}

func TestUpdateChildQuestion(t *testing.T) {

	correctResponseString, _ := json.Marshal([]string{"correct_response"})
	optionsString, _ := json.Marshal([]string{"option 1", "option 2"})

	type vars struct {
		requestBody QuestionSchema
		id          int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we send valid arguments in request body and  question id.",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText:    "child question?",
				QuestionType:    "TEXT_TYPE",
				SectionID:       1,
				RelatedTo:       2,
				RelationalOp:    "=",
				CorrectResponse: []string{"correct_response"},
			},
			id: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"
			mock.ExpectExec(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.QuestionType, v.requestBody.SectionID, nil, v.requestBody.RelationalOp, string(correctResponseString), v.requestBody.RelatedTo, v.id).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should return sql error while trying to add the parent question . ",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText:    "Question?",
				QuestionType:    "SINGLE_SELECT",
				SectionID:       1,
				Options:         []string{"option 1", "option 2"},
				RelatedTo:       2,
				RelationalOp:    "=",
				CorrectResponse: []string{"correct_response"},
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"
			mock.ExpectExec(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.QuestionType, v.requestBody.SectionID, string(optionsString), v.requestBody.RelationalOp, string(correctResponseString), v.requestBody.RelatedTo, v.id).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			err = UpdateChildQuestion(db, tCase.vars.requestBody, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			}
		})
	}

}

func TestUpdateParentQuestion(t *testing.T) {

	optionsString, _ := json.Marshal([]string{"option 1", "option 2"})

	type vars struct {
		requestBody QuestionSchema
		id          int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we send valid arguments in request body and  question id.",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "Parent Question?",
				QuestionType: "TEXT_TYPE",
				SectionID:    1,
				RelationalOp: "=",
			},
			id: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"
			mock.ExpectExec(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.QuestionType, v.requestBody.SectionID, nil, v.requestBody.RelationalOp, v.id).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should return sql error while trying to add the parent question . ",
		vars: vars{
			requestBody: QuestionSchema{
				QuestionText: "Parent Question?",
				QuestionType: "SINGLE_SELECT",
				SectionID:    1,
				Options:      []string{"option 1", "option 2"},
				RelationalOp: "=",
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"
			mock.ExpectExec(expectedQuery).WithArgs(v.requestBody.QuestionText, v.requestBody.QuestionType, v.requestBody.SectionID, string(optionsString), v.requestBody.RelationalOp, v.id).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			err = UpdateParentQuestion(db, tCase.vars.requestBody, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			}
		})
	}

}

func TestGetQuestions(t *testing.T) {

	correctResponseString, _ := json.Marshal([]string{"correct_response"})

	type vars struct {
		sectionID int
		page      int
		size      int
	}

	testCases := []struct {
		name                string
		vars                vars
		dbmock              func(mock sqlmock.Sqlmock, v vars)
		wantParentQuestions []Question
		wantChildQuestions  []Question
		hasErr              bool
		err                 string
	}{{
		name: "should pass while we pass all the required arguments and return the array of questions",
		vars: vars{
			size:      5,
			page:      1,
			sectionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"id", "question_text", "question_type", "question_uuid", "section_id", "options", "correct_response", "relational_operation", "related_to"}).AddRow(1, "parent question?", "TEXT_TYPE", "parent_unique", 1, nil, nil, nil, nil))

			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"id", "question_text", "question_type", "question_uuid", "section_id", "options", "correct_response", "relational_operation", "related_to"}).AddRow(2, "child question?", "TEXT_TYPE", "child_unique", 1, nil, correctResponseString, "=", 1))
		},
		wantParentQuestions: []Question{{ID: 1, QuestionText: "parent question?", QuestionType: "TEXT_TYPE", QuestionUUID: "parent_unique", SectionID: 1}},
		wantChildQuestions:  []Question{{ID: 2, QuestionText: "child question?", QuestionType: "TEXT_TYPE", QuestionUUID: "child_unique", SectionID: 1, RelatedTo: 1, CorrectResponse: string(correctResponseString), RelationalOperation: "="}},
		hasErr:              false,
	}, {
		name: "should return sql error while trying to retrieve the parent questions",
		vars: vars{
			size:      5,
			page:      1,
			sectionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return sql error while trying to retrieve the child questions",
		vars: vars{
			size:      5,
			page:      1,
			sectionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"id", "question_text", "question_type", "question_uuid", "section_id", "options", "correct_response", "relational_operation", "related_to"}).AddRow(1, "parent question?", "TEXT_TYPE", "parent_unique", 1, nil, nil, nil, nil))

			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnError(fmt.Errorf("some error"))
		},
		wantParentQuestions: []Question{{ID: 1, QuestionText: "parent question?", QuestionType: "TEXT_TYPE", QuestionUUID: "parent_unique", SectionID: 1}},

		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {

		t.Run(tCase.name, func(tt *testing.T) {

			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			gotParentQuestions, gotChildQuestions, err := GetQuestions(db, tCase.vars.sectionID, tCase.vars.page, tCase.vars.size)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			} else {
				assert.Equal(tt, tCase.wantParentQuestions, gotParentQuestions, tCase)
				assert.Equal(tt, tCase.wantChildQuestions, gotChildQuestions, tCase)

			}

		})

	}
}

func TestDeleteQuestion(t *testing.T) {
	type vars struct {
		questionID int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass when we pass the question id that is active in the database",
		vars: vars{
			questionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"
			mock.ExpectExec(expectedQuery).WithArgs(strconv.Itoa(v.questionID), strconv.Itoa(v.questionID)).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should return error while we pass the question id that is not active in the database",
		vars: vars{
			questionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "UPDATE questions"
			mock.ExpectExec(expectedQuery).WithArgs(strconv.Itoa(v.questionID), strconv.Itoa(v.questionID)).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			err = DeleteQuestion(db, tCase.vars.questionID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			}
		})
	}

}

func TestIsQuestionExistInSection(t *testing.T) {
	type vars struct {
		questionID int
		sectionID  int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   int
		hasErr bool
		err    string
	}{{
		name: "should pass when we pass valid section ID and the question ID",
		vars: vars{
			questionID: 1,
			sectionID:  1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.questionID), strconv.Itoa(v.sectionID)).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))
		},
		want:   1,
		hasErr: false,
	}, {
		name: "should return sql error while we try to retrieve the no. of rows with given section ID and question ID",
		vars: vars{
			questionID: 1,
			sectionID:  1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.questionID), strconv.Itoa(v.sectionID)).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			got, err := IsQuestionExistInSection(db, tCase.vars.questionID, tCase.vars.sectionID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			} else {
				assert.Equal(tt, tCase.want, got, tCase)
			}
		})
	}
}

func TestIsParentQuestionExist(t *testing.T) {
	type vars struct {
		questionText string
		questionID   int
		sectionID    int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   int
		hasErr bool
		err    string
	}{{
		name: "should pass when we pass all the required arguments",
		vars: vars{
			questionText: "Question?",
			questionID:   1,
			sectionID:    1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.questionText, v.questionID, v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
		},
		want:   0,
		hasErr: false,
	}, {
		name: "should return sql error while we try to retrieve the no. of rows that consists of given question text and section id",
		vars: vars{
			questionText: "Question?",
			questionID:   1,
			sectionID:    1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.questionText, v.questionID, v.sectionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			got, err := IsParentQuestionExist(db, tCase.vars.questionText, tCase.vars.questionID, tCase.vars.sectionID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			} else {
				assert.Equal(tt, tCase.want, got, tCase)
			}
		})
	}
}

func TestGetChildQuestions(t *testing.T) {
	type vars struct {
		parentID int
		id       int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   []string
		hasErr bool
		err    string
	}{{
		name: "should pass and return the array of strings that contains the question texts of the child question of the given parent id",
		vars: vars{
			parentID: 2,
			id:       1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID, v.id).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("child 1").AddRow("child 2"))
		},
		want:   []string{"child 1", "child 2"},
		hasErr: false,
	}, {
		name: "should return sql error while retrieving the question texts of the child questions",
		vars: vars{
			parentID: 2,
			id:       1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID, v.id).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			got, err := GetChildQuestions(db, tCase.vars.parentID, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			} else {
				assert.Equal(tt, tCase.want, got, tCase)
			}
		})
	}

}

func TestIsItRelatedToChildQuestion(t *testing.T) {
	type vars struct {
		parentID int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we pass parent id that exists in the database and that is actually a parent question ID",
		vars: vars{
			parentID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnRows(mock.NewRows([]string{"related_to"}).AddRow(0))
		},
		hasErr: false,
	}, {
		name: "should return sql error while trying to retrieve the related to field of the given parent question ID",
		vars: vars{
			parentID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return error stating child question cannot contain other child questions",
		vars: vars{
			parentID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnRows(mock.NewRows([]string{"related_to"}).AddRow(2))
		},
		hasErr: true,
		err:    "Child question cannot contain other child questions",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			err = IsItRelatedToChildQuestion(db, tCase.vars.parentID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			}
		})
	}
}

func TestDoesParentContainMaximumChildren(t *testing.T) {
	type vars struct {
		parentID int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we pass the parent id that has less than 3 children",
		vars: vars{
			parentID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(2))
		},
		hasErr: false,
	}, {
		name: "should return sql error while trying to retrive no. of child questions for the given parent question ID",
		vars: vars{
			parentID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return error stating parent question contains maximum no. of child questions",
		vars: vars{
			parentID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.parentID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(3))
		},
		hasErr: true,
		err:    "Parent question contains maximum number of children, can not create another child question",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			err = DoesParentContainMaximumChildren(db, tCase.vars.parentID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			}
		})
	}
}

func TestFetchQuestionText(t *testing.T) {
	type vars struct {
		questionID int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   string
		hasErr bool
		err    string
	}{{
		name: "should pass and return the question text of the given question ID",
		vars: vars{
			questionID: 1,
		},
		want: "Question?",
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.questionID)).WillReturnRows(mock.NewRows([]string{"question_text"}).AddRow("Question?"))
		},
		hasErr: false,
	}, {
		name: "should return the sql error while fetching the question text of the given question id",
		vars: vars{
			questionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(strconv.Itoa(v.questionID)).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			got, err := FetchQuestionText(db, tCase.vars.questionID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			} else {
				assert.Equal(tt, tCase.want, got, tCase)
			}
		})
	}
}

func TestFetchQuestionDetails(t *testing.T) {
	type vars struct {
		questionID int
	}

	testCases := []struct {
		name              string
		vars              vars
		dbmock            func(mock sqlmock.Sqlmock, v vars)
		wantQuestionType  string
		wantOptionsString string
		hasErr            bool
		err               string
	}{{
		name: "should pass while we pass the valid question id and should return the options string and the question type",
		vars: vars{
			questionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnRows(mock.NewRows([]string{"question_type", "options"}).AddRow("TEXT_TYPE", nil))
		},
		wantQuestionType:  "TEXT_TYPE",
		wantOptionsString: "",
		hasErr:            false,
	}, {
		name: "should return sql error while trying to retrieve the question type and the options of the given question id ",
		vars: vars{
			questionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.questionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			gotQuestionType, gotOptionsString, err := FetchQuestionDetails(db, tCase.vars.questionID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			} else {
				assert.Equal(tt, tCase.wantQuestionType, gotQuestionType, tCase)
				assert.Equal(tt, tCase.wantOptionsString, gotOptionsString, tCase)

			}
		})
	}
}

func TestGetTotalNumberOfQuestions(t *testing.T) {
	type vars struct {
		sectionID int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   int
		hasErr bool
		err    string
	}{{
		name: "should return number of questions present in the given section ID",
		vars: vars{
			sectionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(10))
		},
		want:   10,
		hasErr: false,
	}, {
		name: "should return sql error while trying to retrieve total number of questions of the given section ID",
		vars: vars{
			sectionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM questions"
			mock.ExpectQuery(expectedQuery).WithArgs(v.sectionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			got, err := GetTotalNumberOfQuestions(db, tCase.vars.sectionID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be occurred here , the error occurred is : %v ", err)
			} else {
				assert.Equal(tt, got, tCase.want, tCase)
			}
		})
	}
}
