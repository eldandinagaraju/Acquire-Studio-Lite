package controllers

import (
	"api/errors"
	"api/helpers"
	"api/services/questions"
	"database/sql"
	"encoding/json"
	"fmt"
	"log"
	"net/http"
	"strconv"

	"github.com/astaxie/beego"
)

type QuestionController struct {
	beego.Controller
	DB *sql.DB
}

// @Title CreateQuestion
// @Summary creates a new question in a section
// @Description creates a new question in a section by taking the required question data as params
// @Security ApiKeyAuth
// @Accept	json
// @Param Authorization header string true "Authorization"
// @Param request body models.QuestionSchema true "query params"
// @Success	201	{object}	questions.QuestionResponseSchema
// @Failure	400	Invalid Section ID
// @Failure	500	Internal Server Error
// @router / [post]
func (q *QuestionController) Post() {
	if response, err := questions.CreateQuestion(q.DB, q.Ctx.Input.RequestBody); err != nil {
		if clientError, ok := err.(errors.ClientError); !ok {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err == nil {
			q.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			q.Ctx.ResponseWriter.Write(body)
		}
	} else {
		q.Data["json"] = helpers.SuccessResponse(http.StatusCreated, "Question created successfully", response)
		q.Ctx.ResponseWriter.WriteHeader(http.StatusCreated)
		q.ServeJSON()
	}
}

// @Title GetQuestions
// @Summary fetches the questions data for a section
// @Description fetches the question data for a given section id and page number
// @Security ApiKeyAuth
// @Param Authorization header string true "Authorization"
// @Param   id    query   int 	true  "id"
// @Param   page  query   int 	true  "page"
// @Accept	json
// @Success	200	{object}	questions.QuestionsListingResponse
// @Failure	400	Invalid Section ID
// @Failure	500	Internal Server Error
// @router / [get]
func (q *QuestionController) Get() {
	sectionID, err := q.GetInt("id")
	page, err1 := q.GetInt("page")

	if err != nil || err1 != nil {
		paramError := errors.NewHTTPError(fmt.Errorf("err: %v, err1: %v", err, err1),
			http.StatusBadRequest, "invalid section id or page number")
		log.Printf("error : %v", paramError)
		if clientError, ok := paramError.(errors.ClientError); !ok {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
			return
		} else if body, err := clientError.ResponseBody(); err == nil {
			q.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			q.Ctx.ResponseWriter.Write(body)
			return
		}
	}

	page, err = q.GetInt("page")

	if err != nil {
		return
	}

	if response, err := questions.GetQuestions(q.DB, sectionID, page); err != nil {
		if clientError, ok := err.(errors.ClientError); !ok {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err == nil {
			q.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			q.Ctx.ResponseWriter.Write(body)
		}
	} else {
		q.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Success", response)
		q.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
		q.ServeJSON()
	}
}

// @Title EditQuestion
// @Summary changes the question data
// @Description changes the question data for a given question id
// @Security ApiKeyAuth
// @Param Authorization header string true "Authorization"
// @Param id                  path	int      true	"id"
// @Param request body models.QuestionSchema true "query params"
// @Accept	json
// @Success	200	{object}	models.QuestionResponseSchema
// @Failure	400	Question not found
// @Failure	500	Internal Server Error
// @router /:id [put]
func (q *QuestionController) Put() {
	id := q.Ctx.Input.Param(":id")
	questionID, err := strconv.Atoi(id)
	if err != nil {
		q.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		return
	}
	if response, err := questions.EditQuestion(q.DB, q.Ctx.Input.RequestBody, questionID); err != nil {
		if clientError, ok := err.(errors.ClientError); !ok {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err == nil {
			q.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			q.Ctx.ResponseWriter.Write(body)
		}
	} else {
		q.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Question updated successfully", response)
		q.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
		q.ServeJSON()
	}
}

// @Title DeleteQuestion
// @Summary deletes a question in a section
// @Description deletes a question in a section for a given question id
// @Security ApiKeyAuth
// @Param Authorization header string true "Authorization"
// @Param id   path	int      true	"id"
// @Accept	json
// @Success	200	{string}	Question deleted successfully
// @Failure	400	Question not found
// @Failure	500	Internal Server Error
// @router /:id [delete]
func (q *QuestionController) Delete() {
	if id, err := strconv.Atoi(q.Ctx.Input.Param(":id")); err != nil {
		if resp, err := json.Marshal(errors.NewHTTPError(err, http.StatusBadRequest, "Invalid question id")); err != nil {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusBadRequest)
			q.Ctx.ResponseWriter.Write(resp)
		}
	} else {
		if err = questions.DeleteQuestion(q.DB, id); err == nil {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
			q.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Question deleted successfully", nil)
			q.ServeJSON()
			return
		}
		if clientError, ok := err.(errors.ClientError); !ok {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if resp, err := clientError.ResponseBody(); err != nil {
			q.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			q.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			q.Ctx.ResponseWriter.Write(resp)
		}
	}
}
