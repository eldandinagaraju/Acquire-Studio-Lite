package middlewares

import (
	"api/helpers"
	"net/http"
	"net/http/httptest"
	"testing"

	"github.com/stretchr/testify/assert"
)

func TestMiddleware(t *testing.T) {
	t.Setenv("JWT_SECRET_KEY", "srinivas1234")
	t.Setenv("JWT_EXPIRE_TIME", "24h")

	type vars struct {
		token      string
		path       string
		methodType string
	}

	validToken, _ := helpers.GenerateJWT("snigda@gmail.com")

	testCases := []struct {
		name   string
		vars   vars
		want   int
		hasErr bool
		err    error
	}{{
		name: "should return statusOK when we pass valid jwt token",
		vars: vars{
			token:      validToken,
			path:       "/formslist",
			methodType: http.MethodGet,
		},
		want:   http.StatusOK,
		hasErr: false,
	}, {
		name: "should return statusUnauthorized when we pass invalid jwt token",
		vars: vars{
			token:      "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2ODg2Mjg1NzgsIlVzZXJOYW1lIjoic25pZ2RoYUBnbWFpbC5jb20ifQ.tqb_0ar4yu_mVkZC86Ei8CVD4SMXt63FhkUzf1z5ZSs",
			path:       "/formslist",
			methodType: http.MethodGet,
		},
		want:   http.StatusUnauthorized,
		hasErr: false,
	}, {
		name: "should return statusBadRequest when we do not pass jwt token",
		vars: vars{
			token:      "",
			path:       "/formslist",
			methodType: http.MethodGet,
		},
		want:   http.StatusBadRequest,
		hasErr: false,
	}, {
		name: "should return statusOK when we do not pass jwt token for login",
		vars: vars{
			token:      "",
			path:       "/api/v1/login",
			methodType: http.MethodPost,
		},
		want:   http.StatusOK,
		hasErr: false,
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			req := httptest.NewRequest(tCase.vars.methodType, tCase.vars.path, nil)
			req.Header.Set("Authorization", tCase.vars.token)

			resp := httptest.NewRecorder()

			JwtMiddleware(http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {})).ServeHTTP(resp, req)

			assert.Equal(t, tCase.want, resp.Code)
		})
	}
}

func TestValidateToken(t *testing.T) {
	t.Setenv("JWT_SECRET_KEY", "srinivas1234")
	t.Setenv("JWT_EXPIRE_TIME", "24h")

	type vars struct {
		token string
	}

	validToken, _ := helpers.GenerateJWT("snigdha@gmail.com")

	testCases := []struct {
		name   string
		vars   vars
		want   bool
		hasErr bool
		err    error
	}{{
		name: "should return true when we pass valid jwt token",
		vars: vars{
			token: validToken,
		},
		want:   true,
		hasErr: false,
	}, {
		name: "should return false when we pass invalid jwt token",
		vars: vars{
			token: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2ODg2Mjg1NzgsIlVzZXJOYW1lIjoic25pZ2RoYUBnbWFpbC5jb20ifQ.tqb_0ar4yu_mVkZC86Ei8CVD4SMXt63FhkUzf1z5ZSs",
		},
		want:   false,
		hasErr: false,
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			resp := httptest.NewRecorder()
			_, isValidToken := validateToken(resp, tCase.vars.token)
			assert.Equal(t, tCase.want, isValidToken)
		})
	}
}

func TestValidateAuthHeader(t *testing.T) {
	type vars struct {
		token string
	}

	testCases := []struct {
		name   string
		vars   vars
		want   bool
		hasErr bool
		err    error
	}{{
		name: "should return true when authorization in header is not empty",
		vars: vars{
			token: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2ODg2Mjg1NzgsIlVzZXJOYW1lIjoic25pZ2RoYUBnbWFpbC5jb20ifQ.tqb_0ar4yu_mVkZC86Ei8CVD4SMXt63FhkUzf1z5ZSs",
		},
		want:   true,
		hasErr: false,
	}, {
		name: "should return false when authorization in header is empty",
		vars: vars{
			token: "",
		},
		want:   false,
		hasErr: false,
	}}

	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			resp := httptest.NewRecorder()
			isAuthorizationEmpty := validateAuthHeader(resp, tCase.vars.token)
			assert.Equal(t, tCase.want, isAuthorizationEmpty)
		})
	}
}
