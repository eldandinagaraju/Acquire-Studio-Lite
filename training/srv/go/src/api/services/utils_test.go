package services

import (
	"fmt"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/stretchr/testify/assert"
)

func TestIsIdExist(t *testing.T) {
	type vars struct {
		tableName string
		id        int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   int
		hasErr bool
		err    string
	}{{
		name: "should pass and return the no. of rows",
		vars: vars{
			tableName: "forms",
			id:        1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM " + v.tableName

			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(2))
		},
		want:   2,
		hasErr: false,
	}, {
		name: "should return sql error while fetching the no. of rows",
		vars: vars{
			tableName: "forms",
			id:        1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM " + v.tableName

			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {

		t.Run(tCase.name, func(tt *testing.T) {

			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating the stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			got, err := IsIdExist(db, tCase.vars.tableName, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be returned here the error returned is : %v", err)
			} else {
				assert.Equal(tt, tCase.want, got, tCase)
			}
		})

	}
}

func TestIsIdExistAndActive(t *testing.T) {
	type vars struct {
		tableName string
		id        int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   int
		hasErr bool
		err    string
	}{{
		name: "should pass and return the no. of rows",
		vars: vars{
			tableName: "forms",
			id:        1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM " + v.tableName

			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(2))
		},
		want:   2,
		hasErr: false,
	}, {
		name: "should return sql error while fetching the no. of rows",
		vars: vars{
			tableName: "forms",
			id:        1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM " + v.tableName

			mock.ExpectQuery(expectedQuery).WithArgs(v.id).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {

		t.Run(tCase.name, func(tt *testing.T) {

			db, mock, err := sqlmock.New()

			if err != nil {
				t.Fatalf("error occurred while creating the stub database connection : %v ", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			got, err := IsIdExistAndActive(db, tCase.vars.tableName, tCase.vars.id)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("this error should not be returned here the error returned is : %v", err)
			} else {
				assert.Equal(tt, tCase.want, got, tCase)
			}
		})

	}
}

func TestConvertToTitle(t *testing.T) {
	type vars struct {
		title string
	}

	testCases := []struct {
		name string
		vars vars
		want string
	}{{
		name: "should pass and return the string int title case",
		vars: vars{
			title: "acquire studio",
		},
		want: "Acquire Studio",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			got := ConvertToTitle(tCase.vars.title)

			assert.Equal(tt, got, tCase.want, tCase)
		})
	}
}

func TestTitleIsTitleValid(t *testing.T) {

	type vars struct {
		title string
	}

	testCases := []struct {
		name     string
		vars     vars
		hasError bool
		error    string
	}{{
		name: "valid title should should not have any error",
		vars: vars{
			title: "test title",
		},
		hasError: false,
	},
		{
			name: "title with no balanced parenthesis should return an error",
			vars: vars{
				title: "test(test",
			},
			hasError: true,
			error:    "Unbalanced brackets",
		},
		{
			name: "title with no balanced angular brackets should return an error",
			vars: vars{
				title: "test[test",
			},
			hasError: true,
			error:    "Unbalanced brackets",
		},
		{
			name: "title with  balanced parenthesis should not return an error",
			vars: vars{
				title: "test()test",
			},
			hasError: false,
		},
		{
			name: "title with balanced angular brackets not should return an error",
			vars: vars{
				title: "test[]test",
			},
			hasError: false,
		},
		{
			name: "title with a special character which is not allowed should throw an error",
			vars: vars{
				title: "test&test",
			},
			hasError: true,
			error:    "invalid question text",
		},
		{
			name: "title with nested brackets with no balance should throw an error",
			vars: vars{
				title: "test[inner(]test",
			},
			hasError: true,
			error:    "Unbalanced brackets",
		},
		{
			name: "title with nested brackets with balance should not throw an error",
			vars: vars{
				title: "test[inner(nested)]test",
			},
			hasError: false,
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			err := IsTitleValid(tCase.vars.title)

			if tCase.hasError {
				assert.Equal(tt, tCase.error, err.Error())
			} else {
				assert.Nil(tt, err)
			}

		})
	}

}
