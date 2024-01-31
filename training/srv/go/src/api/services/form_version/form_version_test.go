package form_version

import (
	"encoding/json"
	"fmt"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/stretchr/testify/assert"
)

func TestPublishVersion(t *testing.T) {
	type vars struct {
		requestBody PublishVersionSchema
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while we pass valid version id in the request body",
		vars: vars{
			requestBody: PublishVersionSchema{
				VersionID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"form_id"}).AddRow(1))

			expectedQuery = "UPDATE form_versions"

			mock.ExpectExec(expectedQuery).WithArgs(1).WillReturnResult(sqlmock.NewResult(1, 1))

			mock.ExpectExec(expectedQuery).WithArgs(1).WillReturnResult(sqlmock.NewResult(1, 1))

		},
		hasErr: false,
	}, {
		name: "should return sql error while checking whether the version exists or not",
		vars: vars{
			requestBody: PublishVersionSchema{
				VersionID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return sql error while checking whether the version is active or not",
		vars: vars{
			requestBody: PublishVersionSchema{
				VersionID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return with error version not found",
		vars: vars{
			requestBody: PublishVersionSchema{
				VersionID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
		},
		hasErr: true,
		err:    "Version not found",
	}, {
		name: "should return with error cannot publish this version when the version is inactive",
		vars: vars{
			requestBody: PublishVersionSchema{
				VersionID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
		},
		hasErr: true,
		err:    "Can not publish this version",
	}, {
		name: "should return sql error while trying to fetch the form ID of the given version ID",
		vars: vars{
			requestBody: PublishVersionSchema{
				VersionID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return sql error while publishing the version",
		vars: vars{
			requestBody: PublishVersionSchema{
				VersionID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.VersionID).WillReturnRows(mock.NewRows([]string{"form_id"}).AddRow(1))

			expectedQuery = "UPDATE form_versions"

			mock.ExpectExec(expectedQuery).WithArgs(1).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				tt.Fatalf("error occurred while creating stub database connection : %v", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			reqBody, err := json.Marshal(tCase.vars.requestBody)

			if err != nil {
				tt.Errorf("Marshalling error : %v", err)

			}

			err = PublishVersion(db, reqBody)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("This error should not be returned here , the error returned is : %v", err)
			}
		})
	}
}

func TestCreateVersion(t *testing.T) {
	type vars struct {
		requestBody CreateVersionSchema
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		want   CreateVersionResponseSchema
		hasErr bool
		err    string
	}{{
		name: "should pass while sending the valid form ID in the request Body",
		vars: vars{
			requestBody: CreateVersionSchema{
				ID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM forms"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.ID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.ID).WillReturnRows(mock.NewRows([]string{"version_code"}).AddRow("v1"))

			expectedQuery = "INSERT INTO form_versions"

			mock.ExpectExec(expectedQuery).WillReturnResult(sqlmock.NewResult(2, 1))
		},
		want:   CreateVersionResponseSchema{ID: 2, VersionCode: "v2"},
		hasErr: false,
	}, {
		name: "should return sql error while checking whether the form id exists or not",
		vars: vars{
			requestBody: CreateVersionSchema{
				ID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM forms"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.ID).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return with error form not found",
		vars: vars{
			requestBody: CreateVersionSchema{
				ID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM forms"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.ID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))

		},
		hasErr: true,
		err:    "Form not found",
	}, {
		name: "should return sql error while getting the last version code from the database",
		vars: vars{
			requestBody: CreateVersionSchema{
				ID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM forms"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.ID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.ID).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return sql error while creating a new version",
		vars: vars{
			requestBody: CreateVersionSchema{
				ID: 1,
			},
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM forms"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.ID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.requestBody.ID).WillReturnRows(mock.NewRows([]string{"form_id"}).AddRow("v1"))

			expectedQuery = "INSERT INTO form_versions"
			mock.ExpectExec(expectedQuery).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				tt.Fatalf("error occurred while creating stub database connection : %v", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			reqBody, err := json.Marshal(tCase.vars.requestBody)

			if err != nil {
				tt.Errorf("Marshalling error : %v", err)

			}

			got, err := CreateVersion(db, reqBody)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("This error should not be returned here , the error returned is : %v", err)
			} else {
				assert.Equal(tt, tCase.want, got, tCase)
			}
		})
	}

}

func TestDeleteVersion(t *testing.T) {
	type vars struct {
		versionID int
	}

	testCases := []struct {
		name   string
		vars   vars
		dbmock func(mock sqlmock.Sqlmock, v vars)
		hasErr bool
		err    string
	}{{
		name: "should pass while passing the valid version ID",
		vars: vars{
			versionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.versionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "UPDATE form_versions"
			mock.ExpectExec(expectedQuery).WithArgs(v.versionID).WillReturnResult(sqlmock.NewResult(1, 1))
		},
		hasErr: false,
	}, {
		name: "should return sql error while checking whether the version exists or not",
		vars: vars{
			versionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.versionID).WillReturnError(fmt.Errorf("some error"))

		},
		hasErr: true,
		err:    "some error",
	}, {
		name: "should return with error version not found",
		vars: vars{
			versionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.versionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(0))
		},
		hasErr: true,
		err:    "Version not found",
	}, {
		name: "should return with sql error while deleting the version",
		vars: vars{
			versionID: 1,
		},
		dbmock: func(mock sqlmock.Sqlmock, v vars) {
			expectedQuery := "SELECT .+ FROM form_versions"

			mock.ExpectQuery(expectedQuery).WithArgs(v.versionID).WillReturnRows(mock.NewRows([]string{"count"}).AddRow(1))

			expectedQuery = "UPDATE form_versions"

			mock.ExpectExec(expectedQuery).WithArgs(v.versionID).WillReturnError(fmt.Errorf("some error"))
		},
		hasErr: true,
		err:    "some error",
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			db, mock, err := sqlmock.New()

			if err != nil {
				tt.Fatalf("error occurred while creating stub database connection : %v", err)
			}

			defer db.Close()

			if tCase.dbmock != nil {
				tCase.dbmock(mock, tCase.vars)
			}

			err = DeleteVersion(db, tCase.vars.versionID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error(), tCase)
			} else if err != nil {
				t.Errorf("This error should not be returned here , the error returned is : %v", err)
			}
		})
	}
}
