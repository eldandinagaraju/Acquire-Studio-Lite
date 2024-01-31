package helpers

import (
	"encoding/json"
	"os"
	"strings"
	"time"

	"github.com/golang-jwt/jwt"
	"github.com/google/uuid"
)

type ContextKey string

type TokenClaims struct {
	jwt.StandardClaims
	UserName string
}

type Response struct {
	Status  int         `json:"status"`
	Message string      `json:"message"`
	Data    interface{} `json:"data"`
}

// generates a jwt token that expires after 24 hrs
func GenerateJWT(email string) (tokenString string, err error) {
	token := jwt.New(jwt.SigningMethodHS256)
	var jwtExpireTime time.Duration
	if jwtExpireTime, err = time.ParseDuration(os.Getenv("JWT_EXPIRE_TIME")); err != nil {
		return "", err
	}
	claims := TokenClaims{
		StandardClaims: jwt.StandardClaims{
			ExpiresAt: time.Now().Add(jwtExpireTime).Unix(),
		},
		UserName: email,
	}
	token.Claims = &claims
	if tokenString, err = token.SignedString([]byte(os.Getenv("JWT_SECRET_KEY"))); err != nil {
		return "", err
	}
	return tokenString, nil
}

func GenerateUUID() string {
	id := uuid.New()
	return id.String()
}

func SuccessResponse(statusCode int, message string, data interface{}) Response {
	return Response{
		Status:  statusCode,
		Message: message,
		Data:    data,
	}
}

func IsEmpty(item string) bool {
	return len(strings.TrimSpace(item)) == 0
}

// to convert the options array and correctResponse array into strings
func ConvertSliceToStrFormat(optionsArray []string, correctResponseArray []string) (interface{}, interface{}, error) {

	var convertedOptions interface{}
	var convertedCorrectResponse interface{}

	if len(optionsArray) == 0 {
		convertedOptions = nil
	} else if optionsString, err := json.Marshal(optionsArray); err != nil {
		return nil, nil, err
	} else {
		convertedOptions = string(optionsString)
	}

	if len(correctResponseArray) == 0 {
		convertedCorrectResponse = nil
	} else if correctResponseString, err := json.Marshal(correctResponseArray); err != nil {
		return nil, nil, err
	} else {
		convertedCorrectResponse = string(correctResponseString)
	}

	return convertedOptions, convertedCorrectResponse, nil
}
