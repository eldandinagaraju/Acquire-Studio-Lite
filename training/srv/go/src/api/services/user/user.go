package user

import (
	"api/errors"
	"api/helpers"
	"api/models"
	"database/sql"
	"encoding/json"
	"golang.org/x/crypto/bcrypt"
	"net/http"
	"os"
	"time"
)

type LoginRequestSchema struct {
	Email    string `json:"email"`
	Password string `json:"password"`
}

type LoginResponseSchema struct {
	ExpireTime string `json:"expireTime"`
	JwtToken   string `json:"jwtToken"`
}

// checks whether the username and password of request data matches with the username and password in users table
// if the data matches jwt token is generated that expires after 24 hrs
func ValidateUser(db *sql.DB, requestBody []byte) (response LoginResponseSchema, err error) {
	var requestData LoginRequestSchema
	if err := json.Unmarshal([]byte(requestBody), &requestData); err != nil {
		return response, errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid json")
	}

	if userCredentials, err := models.GetUserData(db, requestData.Email); err != nil {
		return response, err
	} else if err = bcrypt.CompareHashAndPassword([]byte(userCredentials.Password), []byte(requestData.Password)); err != nil {
		return response, errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid username or password")
	}

	if jwtToken, err := helpers.GenerateJWT(requestData.Email); err != nil {
		return response, err
	} else if jwtTokenExpireTime, err := time.ParseDuration(os.Getenv("JWT_EXPIRE_TIME")); err != nil {
		return response, err
	} else {
		response = LoginResponseSchema{ExpireTime: time.Now().Add(jwtTokenExpireTime).String(), JwtToken: jwtToken}
		return response, nil
	}
}
