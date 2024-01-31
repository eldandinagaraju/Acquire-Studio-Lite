package middlewares

import (
	"api/errors"
	"api/helpers"
	"context"
	"encoding/json"
	"net/http"
	"os"
	"strings"

	"github.com/golang-jwt/jwt"
)

func JwtMiddleware(next http.Handler) http.Handler {
	return http.HandlerFunc(
		func(w http.ResponseWriter, r *http.Request) {
			if !strings.Contains(r.URL.String(), "swagger") {
				w.Header().Set("Content-Type", "application/json")
			}
			urlInLowerCase := strings.ToLower(r.URL.String())
			if (strings.Contains(urlInLowerCase, "login") && r.Method == "POST") ||
				r.Method == "OPTIONS" || strings.Contains(urlInLowerCase, "swagger") {
				next.ServeHTTP(w, r)
				return
			}
			authHeader := r.Header.Get("Authorization")
			if isValid := validateAuthHeader(w, authHeader); !isValid {
				return
			}
			jwtToken := strings.Replace(authHeader, "Bearer ", "", 1)
			token, isValidToken := validateToken(w, jwtToken)
			if !isValidToken {
				return
			}
			if claims, ok := token.Claims.(*helpers.TokenClaims); ok && token.Valid {
				ctx := context.WithValue(r.Context(), helpers.ContextKey("username"), claims.UserName)
				next.ServeHTTP(w, r.WithContext(ctx))
				return
			}
			next.ServeHTTP(w, r)
		})
}

func validateAuthHeader(w http.ResponseWriter, authHeader string) bool {
	if authHeader == "" {
		if resp, err := json.Marshal(errors.NewHTTPError(nil, http.StatusBadRequest, "Authorization token is missing")); err != nil {
			w.WriteHeader(http.StatusInternalServerError)
		} else {
			w.WriteHeader(http.StatusBadRequest)
			w.Write(resp)
		}
		return false
	}
	return true
}

func validateToken(w http.ResponseWriter, jwtToken string) (*jwt.Token, bool) {
	token, err := jwt.ParseWithClaims(jwtToken, &helpers.TokenClaims{},
		func(token *jwt.Token) (interface{}, error) {
			return []byte(os.Getenv("JWT_SECRET_KEY")), nil
		})
	if err != nil {
		if resp, err := json.Marshal(errors.NewHTTPError(nil, http.StatusUnauthorized, "Invalid jwt token")); err != nil {
			w.WriteHeader(http.StatusInternalServerError)
		} else {
			w.WriteHeader(http.StatusUnauthorized)
			w.Write(resp)
		}
		return nil, false
	}
	if !token.Valid {
		if resp, err := json.Marshal(errors.NewHTTPError(nil, http.StatusUnauthorized, "Invalid jwt token")); err != nil {
			w.WriteHeader(http.StatusInternalServerError)
		} else {
			w.WriteHeader(http.StatusUnauthorized)
			w.Write(resp)
		}
		return nil, false
	}
	return token, true
}
