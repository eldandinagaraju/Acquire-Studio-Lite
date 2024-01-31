package models

import (
	"api/errors"
	"fmt"
	"net/http"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/stretchr/testify/assert"
)

func TestIsSectionTitleExist(t *testing.T) {
	type vars struct {
		versionId    int
		sectionTitle string
		sectionID    int
	}

	testCases := []struct {
		name     string
		vars     vars
		dbmock   func(mock sqlmock.Sqlmock, v vars)
		want     int64
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			vars: vars{versionId: 1, sectionTitle: "test section title", sectionID: 1},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) as count FROM sections WHERE version_id=\? AND TRIM\(LOWER\(title\)\)=\? AND row_status=1 AND id!=\?`).
					WithArgs(v.versionId, v.sectionTitle, v.sectionID).WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{versionId: 1, sectionTitle: "test section title", sectionID: 1},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				res := sqlmock.NewRows([]string{
					"count",
				}).AddRow(0)
				mock.ExpectQuery(`SELECT COUNT\(\*\) as count FROM sections WHERE version_id=\? AND TRIM\(LOWER\(title\)\)=\? AND row_status=1 AND id!=\?`).
					WithArgs(v.versionId, v.sectionTitle, v.sectionID).WillReturnRows(res)
			},
		},
		{
			name: "should throw an error when the result of query is not equal to zero",
			vars: vars{versionId: 1, sectionTitle: "test section title", sectionID: 1},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				res := sqlmock.NewRows([]string{
					"count",
				}).AddRow(1)
				mock.ExpectQuery(`SELECT COUNT\(\*\) as count FROM sections WHERE version_id=\? AND TRIM\(LOWER\(title\)\)=\? AND row_status=1 AND id!=\?`).
					WithArgs(v.versionId, v.sectionTitle, v.sectionID).WillReturnRows(res)
			},
			hasError: true,
			err:      errors.NewHTTPError(nil, http.StatusBadRequest, "'test section title' already exists.").Error(),
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			versionId := tCase.vars.versionId
			sectionTitle := tCase.vars.sectionTitle
			sectionID := tCase.vars.sectionID

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			err = IsSectionTitleExist(db, versionId, sectionTitle, sectionID)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			} else {
				assert.Nilf(tt, err, "case : %v", tCase)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}

func TestGetSections(t *testing.T) {
	type vars struct {
		versionId int
	}

	testCases := []struct {
		name     string
		vars     vars
		dbmock   func(mock sqlmock.Sqlmock, v vars)
		want     []*SectionSchema
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			vars: vars{versionId: 1},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				mock.ExpectQuery(`SELECT id,title  FROM sections WHERE version_id=\? AND row_status=1`).
					WithArgs(v.versionId).WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{versionId: 1},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				res := sqlmock.NewRows([]string{
					"id",
					"title",
				}).
					AddRow(1, "test section 1").
					AddRow(2, "test section 2")

				mock.ExpectQuery(`SELECT id,title  FROM sections WHERE version_id=\? AND row_status=1`).
					WithArgs(v.versionId).
					WillReturnRows(res)
			},
			want: []*SectionSchema{{1, "test section 1"}, {2, "test section 2"}},
		},
		{
			name: "should return empty array when there are now rows",
			vars: vars{versionId: 1},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				res := sqlmock.NewRows([]string{
					"id",
					"title",
				})
				mock.ExpectQuery(`SELECT id,title  FROM sections WHERE version_id=\? AND row_status=1`).
					WithArgs(v.versionId).
					WillReturnRows(res)
			},
			want: []*SectionSchema(nil),
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
				tCase.dbmock(mock, tCase.vars) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			got, err := GetSections(db, versionId)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			} else {
				assert.Equal(tt, tCase.want, got)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}

func TestCreateSection(t *testing.T) {
	type vars struct {
		versionId    int
		sectionTitle string
	}

	testCases := []struct {
		name     string
		vars     vars
		dbmock   func(mock sqlmock.Sqlmock, v vars)
		want     int64
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			vars: vars{versionId: 1, sectionTitle: "test section title 1"},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				mock.ExpectExec(`INSERT INTO sections \( section_uuid, version_id, title \) VALUES \( \?, \?, \? \)`).
					WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{versionId: 1, sectionTitle: "test section title 1"},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				mock.ExpectExec(`INSERT INTO sections \( section_uuid, version_id, title \) VALUES \( \?, \?, \? \)`).
					WillReturnResult(sqlmock.NewResult(1, 1))
			},
			want: 1,
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			versionId := tCase.vars.versionId
			sectionTitle := tCase.vars.sectionTitle

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			got, err := CreateSection(db, versionId, sectionTitle)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			} else {
				assert.Equal(tt, tCase.want, got)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}
func TestEditSection(t *testing.T) {
	type vars struct {
		sectionId    int
		sectionTitle string
	}

	testCases := []struct {
		name     string
		vars     vars
		dbmock   func(mock sqlmock.Sqlmock, v vars)
		want     int64
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			vars: vars{sectionId: 1, sectionTitle: "test section title 1"},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				mock.ExpectExec(`UPDATE sections SET title=\? WHERE id=\?`).
					WithArgs(v.sectionTitle, v.sectionId).
					WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{sectionId: 1, sectionTitle: "test section title 1"},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				mock.ExpectExec(`UPDATE sections SET title=\? WHERE id=\?`).
					WithArgs(v.sectionTitle, v.sectionId).
					WillReturnResult(sqlmock.NewResult(1, 1))
			},
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			sectionId := tCase.vars.sectionId
			sectionTitle := tCase.vars.sectionTitle

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			err = EditSection(db, sectionId, sectionTitle)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			} else {
				assert.Nil(tt, err)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}
func TestDeleteSection(t *testing.T) {
	type vars struct {
		sectionId int
	}

	testCases := []struct {
		name     string
		vars     vars
		dbmock   func(mock sqlmock.Sqlmock, v vars)
		want     int64
		hasError bool
		err      string
	}{
		{
			name: "should fail when orm.Raw returns an error",
			vars: vars{sectionId: 1},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				mock.ExpectExec(`UPDATE sections SET row_status=0 WHERE id=\?`).
					WithArgs(v.sectionId).
					WillReturnError(fmt.Errorf("some error"))
			},
			hasError: true,
			err:      "some error",
		},
		{
			name: "should succeed when the query is executed successfully",
			vars: vars{sectionId: 1},
			dbmock: func(mock sqlmock.Sqlmock, v vars) {
				mock.ExpectExec(`UPDATE sections SET row_status=0 WHERE id=\?`).
					WithArgs(v.sectionId).
					WillReturnResult(sqlmock.NewResult(1, 1))
			},
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			// Setup.
			sectionId := tCase.vars.sectionId

			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(tt, err) {
				tt.FailNow()
			}

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars) // run the defined mock
			}

			mock.ExpectClose()

			// Test function.
			err = DeleteSection(db, sectionId)

			// Clean up.
			assert.NoError(tt, db.Close())

			// Assertion.
			if tCase.hasError {
				assert.Containsf(tt, tCase.err, err.Error(), "case : %v", tCase)
			} else {
				assert.Nil(tt, err)
			}

			assert.NoError(tt, mock.ExpectationsWereMet())
		})
	}
}
