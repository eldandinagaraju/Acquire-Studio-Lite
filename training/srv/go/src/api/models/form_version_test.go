package models

import (
	"fmt"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/beego/beego/v2/client/orm"
	"github.com/stretchr/testify/assert"
)

func TestPublishVersion(t *testing.T) {

	type vars struct {
		formId    int
		versionId int
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
			name: "should fail when orm.Raw for un-publish a version returns an error",
			vars: vars{formId: 1, versionId: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("UPDATE form_versions SET is_published=0 WHERE form_id=?").WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should fail when orm.Raw for publish a version returns an error",
			vars: vars{formId: 1, versionId: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("UPDATE form_versions SET is_published=0 WHERE form_id=?").WithArgs(1).WillReturnResult(sqlmock.NewResult(1, 1))
				mock.ExpectExec("UPDATE form_versions SET is_published=1 WHERE id=?").WithArgs(1).WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when the queries are executed successfully",
			vars: vars{formId: 1, versionId: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("UPDATE form_versions SET is_published=0 WHERE form_id=?").WithArgs(1).WillReturnResult(sqlmock.NewResult(1, 1))
				mock.ExpectExec("UPDATE form_versions SET is_published=1 WHERE id=?").WithArgs(1).WillReturnResult(sqlmock.NewResult(1, 1))
			},
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			formId := tCase.vars.formId
			versionId := tCase.vars.versionId

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			err = PublishVersion(db, formId, versionId)

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

func TestDeleteVersion(t *testing.T) {

	type vars struct {
		versionId int
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
			vars: vars{versionId: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("UPDATE form_versions SET row_status = 0 WHERE id = ?").WithArgs(1).WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{versionId: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("UPDATE form_versions SET row_status = 0 WHERE id = ?").WithArgs(1).WillReturnResult(sqlmock.NewResult(1, 1))
			},
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			versionId := tCase.vars.versionId

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			err = DeleteVersion(db, versionId)

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

func TestCreateVersion(t *testing.T) {

	type vars struct {
		versionId   int
		versionCode int
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
			vars: vars{versionId: 1, versionCode: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("INSERT INTO form_versions .+").WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{versionId: 1, versionCode: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("INSERT INTO form_versions .+").WillReturnResult(sqlmock.NewResult(1, 1))
			},
			want: 1,
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{versionId: 1, versionCode: 1},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectExec("INSERT INTO form_versions .+").WillReturnError(orm.ErrLastInsertIdUnavailable)
			},
			hasError: true,
			err:      orm.ErrLastInsertIdUnavailable.Error(),
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			versionId := tCase.vars.versionId
			versionCode := tCase.vars.versionCode

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			got, err := CreateVersion(db, versionId, versionCode)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			} else {
				assert.Equalf(tt, tCase.want, got, "case :%v", tCase)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}
