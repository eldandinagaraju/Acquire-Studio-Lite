package models

import (
	"fmt"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/beego/beego/v2/client/orm"
	"github.com/stretchr/testify/assert"
)

func TestCreateForm(t *testing.T) {

	type vars struct {
		title string
	}

	testCases := []struct {
		name     string
		vars     vars
		dbmock   func(mock sqlmock.Sqlmock)
		want     int64
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			vars: vars{title: "Test Form Title"},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("INSERT INTO forms").WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should fail when sqlResponse.LastInsertId returns an error",
			vars: vars{title: "Test Form Title"},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("INSERT INTO forms").WillReturnError(orm.ErrLastInsertIdUnavailable)
			},
			hasError: true,
			err:      orm.ErrLastInsertIdUnavailable.Error(),
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{title: "Test Form Title"},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("INSERT INTO forms").WillReturnResult(sqlmock.NewResult(1, 1))
			},
			want: 1,
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			formTitle := tCase.vars.title

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			got, err := CreateForm(db, formTitle)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			} else {
				assert.Equalf(tt, tCase.want, got, "case : %v", tCase)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}

func TestDeleteForm(t *testing.T) {

	type vars struct {
		id int
	}

	testCases := []struct {
		name     string
		vars     vars
		dbmock   func(mock sqlmock.Sqlmock)
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			vars: vars{id: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec(`UPDATE forms SET row_status=0 WHERE id = \?`).WithArgs(1).WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when query executes successfully",
			vars: vars{id: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec(`UPDATE forms SET row_status=0 WHERE id = \?`).WithArgs(1).WillReturnError(fmt.Errorf("Form ID does not e"))
			},
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			id := tCase.vars.id

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			err = DeleteForm(db, id)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}

func TestEditForm(t *testing.T) {

	type vars struct {
		id    int
		title string
	}

	testCases := []struct {
		name     string
		vars     vars
		dbmock   func(mock sqlmock.Sqlmock)
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			vars: vars{title: "modifiedTitle", id: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("UPDATE forms").WithArgs("modifiedTitle", 1).WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when query executes successfully",
			vars: vars{title: "modifiedTitle", id: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("UPDATE forms").WithArgs("modifiedTitle", 1).WillReturnResult(sqlmock.NewResult(1, 1))
			},
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			id := tCase.vars.id
			title := tCase.vars.title

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			err = EditForm(db, id, title)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}

func TestGetAllForms(t *testing.T) {

	testCases := []struct {
		name     string
		dbmock   func(mock sqlmock.Sqlmock)
		want     []*FormJoinVersionSchema
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery("SELECT forms.id, forms.title, form_versions.id as version_id, form_versions.version_code, form_versions.is_published FROM forms LEFT JOIN form_versions ON forms.id = form_versions.form_id").WithArgs().WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when query executes successfully",
			dbmock: func(mock sqlmock.Sqlmock) {
				rows := sqlmock.NewRows([]string{"id", "title", "version_id", "version_code", "is_published"}).
					AddRow("1", "test form", "1", "v1", "0").
					AddRow("2", "test form 1", "2", "v1", "0")
				mock.ExpectQuery("SELECT forms.id, forms.title, form_versions.id as version_id, form_versions.version_code, form_versions.is_published FROM forms LEFT JOIN form_versions ON forms.id = form_versions.form_id").WithArgs().WillReturnRows(rows)
			},
			want: []*FormJoinVersionSchema{
				{1, "test form", 1, "v1", false},
				{2, "test form 1", 2, "v1", false},
			},
		},
		{
			name: "should return empty when there are no rows",
			dbmock: func(mock sqlmock.Sqlmock) {
				rows := sqlmock.NewRows([]string{"id", "title", "version_id", "version_code", "is_published"})

				mock.ExpectQuery("SELECT forms.id, forms.title, form_versions.id as  version_id, form_versions.version_code, form_versions.is_published FROM forms LEFT JOIN form_versions ON forms.id = form_versions.form_id").WithArgs().WillReturnRows(rows)
			},
			want: []*FormJoinVersionSchema(nil),
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			got, err := GetAllForms(db)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			} else {
				assert.Equalf(tt, tCase.want, got, "case : %v", tCase)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}
