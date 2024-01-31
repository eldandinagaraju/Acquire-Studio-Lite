package user

import (
	"encoding/json"
	"github.com/DATA-DOG/go-sqlmock"
	"github.com/beego/beego/v2/client/orm"
	"github.com/stretchr/testify/assert"
	"golang.org/x/crypto/bcrypt"
	"regexp"
	"testing"
)

func TestValidateUser(t *testing.T) {
	t.Setenv("JWT_EXPIRE_TIME", "24h")
	t.Setenv("JWT_SECRET_KEY", "srinivas1234")

	db, mock, err := sqlmock.New()

	if err != nil {
		t.Fatalf("an error '%s' was not expected when opening a stub database connection", err)
	}

	defer db.Close()
	type vars struct {
		Email    string `json:"email"`
		Password string `json:"password"`
	}

	testCases := []struct {
		name   string
		vars   vars
		mock   func(sqlmock.Sqlmock)
		hasErr bool
		err    string
	}{{
		name: "should pass",
		vars: vars{
			Email:    "vasu@gmail.com",
			Password: "123456789",
		},
		mock: func(mock sqlmock.Sqlmock) {
			pb, _ := bcrypt.GenerateFromPassword([]byte("123456789"), 14)
			expectedQuery := "SELECT username, password FROM users"
			rows := sqlmock.NewRows([]string{"username", "password"}).AddRow("vasu@gmail.com", pb)
			mock.ExpectQuery(regexp.QuoteMeta(expectedQuery)).WithArgs("vasu@gmail.com").WillReturnRows(rows)
		},
		hasErr: false,
	}, {
		name: "should fail with error no rows",
		vars: vars{
			Email:    "invalid@gmail.com",
			Password: "invalid",
		},
		mock: func(mock sqlmock.Sqlmock) {
			expectedQuery := "SELECT username, password FROM users WHERE username = ?"
			mock.ExpectQuery(expectedQuery).WithArgs("invalid@gmail.com").WillReturnError(orm.ErrNoRows)
		},
		hasErr: true,
		err:    orm.ErrNoRows.Error(),
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.mock != nil {
				tCase.mock(mock)
			}

			requestBody, err := json.Marshal(tCase.vars)

			_, err = ValidateUser(db, requestBody)

			if tCase.hasErr {
				assert.Equal(tt, err.Error(), tCase.err)
			} else if err != nil {
				t.Fatalf("An Unknown Error occured which should not come , error : %v", err)
			}
		})
	}
}
