package errors

import (
	"encoding/json"
	"fmt"
)

type ClientError interface {
	Error() string
	ResponseBody() ([]byte, error)
	ResponseCode() int
}

type HTTPError struct {
	Cause  error       `json:"-"`
	Status int         `json:"status"`
	Detail string      `json:"message"`
	Data   interface{} `json:"data"`
}

func (e *HTTPError) Error() string {
	if e.Cause == nil {
		return e.Detail
	}
	return e.Detail + " : " + e.Cause.Error()
}

func (e *HTTPError) ResponseBody() ([]byte, error) {
	body, err := json.Marshal(e)
	if err != nil {
		return nil, fmt.Errorf("Error while parsing response body: %v", err)
	}
	return body, nil
}

func (e *HTTPError) ResponseCode() int {
	return e.Status
}

func NewHTTPError(err error, status int, detail string) error {
	return &HTTPError{
		Cause:  err,
		Detail: detail,
		Status: status,
	}
}
