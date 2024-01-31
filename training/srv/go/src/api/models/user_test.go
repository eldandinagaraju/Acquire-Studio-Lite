package models

import (
	"database/sql"
	"github.com/DATA-DOG/go-sqlmock"
	"github.com/beego/beego/v2/client/orm"
	"github.com/stretchr/testify/assert"
	"os"
	"testing"
)

func TestMain(m *testing.M) {
	// orm.Debug = true
	code := m.Run()
	os.Exit(code)
}

func TestGetUserData(t *testing.T) {
	type vars struct {
		email string
	}

	testCases := []struct {
		name   string // name of test case; eg. "should fail when dividing number by 0"
		vars   vars
		dbmock func(sqlmock.Sqlmock)
		want   *Details
		hasErr bool
		err    string
	}{
		{
			name: "should succeed when the db query executes successfully",
			vars: vars{
				email: "harsha@gmail.com",
			},
			dbmock: func(mock sqlmock.Sqlmock) {
				row := sqlmock.NewRows([]string{"username", "password"}).
					AddRow("harsha@gmail.com", "Password@1")
				mock.ExpectQuery("SELECT (.+) FROM users").WithArgs("harsha@gmail.com").WillReturnRows(row)
			},
			want: &Details{Email: "harsha@gmail.com", Password: "Password@1"},
		},
		{
			name: "should return an error when db throw no row error",
			vars: vars{
				email: "harsha@gmail.com",
			},
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery("SELECT (.+) FROM users").WithArgs("harsha@gmail.com").WillReturnError(sql.ErrNoRows)
			},
			hasErr: true,
			err:    orm.ErrNoRows.Error(),
		},
	}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(t *testing.T) {
			// Setup.
			db, mock, err := sqlmock.New() // initialize mock db client
			if !assert.NoError(t, err) {
				t.FailNow()
			}
			if tCase.dbmock != nil { // run db mock queries, if provided.
				tCase.dbmock(mock)
			}
			mock.ExpectClose()

			// Run test.
			got, err := GetUserData(db, tCase.vars.email) // call function to be tested.

			// Clean up.
			assert.NoError(t, db.Close())

			// Assert.
			if tCase.hasErr {
				assert.Containsf(t, tCase.err, err.Error(), "case: %v", tCase)
			} else {
				assert.Equal(t, tCase.want, got)
			}
			assert.NoError(t, mock.ExpectationsWereMet())
		})
	}
}
