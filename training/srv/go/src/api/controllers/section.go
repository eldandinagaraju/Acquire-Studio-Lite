package controllers

import (
	"api/errors"
	"api/helpers"
	"api/services/sections"
	"database/sql"
	"encoding/json"
	"log"
	"net/http"
	"strconv"

	"github.com/astaxie/beego"
)

type SectionController struct {
	beego.Controller
	DB *sql.DB
}

// @Title GetSections
// @Summary fetches all sections for a form version
// @Description fetches all sections from sections table for a given form version id
// @Security ApiKeyAuth
// @Param Authorization header string true "Authorization"
// @Accept	json
// @Param id                  path	int      true	"id"
// @Success	200	{object}	models.SectionSchema
// @Failure	400	Version not found
// @Failure	500	Internal Server Error
// @router / [get]
func (s *SectionController) Get() {
	username := s.Ctx.Request.Context().Value(helpers.ContextKey("username")).(string)
	versionID, err := s.GetInt("versionID")
	if err != nil {
		paramError := errors.NewHTTPError(err, http.StatusBadRequest, "invalid version id")
		log.Printf("error : %v", paramError)
		if clientError, ok := paramError.(errors.ClientError); !ok {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
			return
		} else if body, err := clientError.ResponseBody(); err == nil {
			s.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			s.Ctx.ResponseWriter.Write(body)
			return
		}
	}

	if username == "" {
		log.Println("Error : Username cannot be blank")
		s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
	} else if response, err := sections.GetAllSections(s.DB, versionID); err == nil {
		s.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
		s.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Success", response)
		s.ServeJSON()
	} else {
		if clientError, ok := err.(errors.ClientError); !ok {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err != nil {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			s.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			s.Ctx.ResponseWriter.Write(body)
		}
	}
}

// @Title CreateSection
// @Summary creates a new section in a form version
// @Description creates a new section in a version by taking version id and section title as params
// @Security ApiKeyAuth
// @Param Authorization header string true "Authorization"
// @Accept	json
// @Param request body sections.CreateSectionSchema true "query params"
// @Success	200	{object}	sections.CreateSectionResponseSchema
// @Failure	400 Version not found
// @Failure	500	Internal Server Error
// @router / [post]
func (s *SectionController) Post() {
	if response, err := sections.CreateSection(s.DB, s.Ctx.Input.RequestBody); err != nil {
		if clientError, ok := err.(errors.ClientError); !ok {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err != nil {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			s.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			s.Ctx.ResponseWriter.Write(body)
		}
	} else {
		s.Ctx.ResponseWriter.WriteHeader(http.StatusCreated)
		s.Data["json"] = helpers.SuccessResponse(http.StatusCreated, "Section created successfully", response)
		s.ServeJSON()
	}
}

// @Title EditSection
// @Summary changes the title of a section
// @Description changes the title of a given section id in form version by taking section id as params
// @Security ApiKeyAuth
// @Param Authorization header string true "Authorization"
// @Accept	json
// @Param id                  path	int      true	"id"
// @Param request body sections.SectionEditSchema true "query params"
// @Success	200	{object}	sections.SectionEditSchema
// @Failure	400	Section not found
// @Failure	500	Internal Server Error
// @router /:id [patch]
func (s *SectionController) Patch() {
	if sectionID, err := strconv.Atoi(s.Ctx.Input.Param(":id")); err != nil {
		s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
	} else if response, err := sections.EditSection(s.DB, s.Ctx.Input.RequestBody, sectionID); err != nil {
		if clientError, ok := err.(errors.ClientError); !ok {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
			return
		} else if body, err := clientError.ResponseBody(); err != nil {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
			return
		} else {
			s.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			s.Ctx.ResponseWriter.Write(body)
			return
		}
	} else {
		s.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Section title updated successfully", response)
		s.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
		s.ServeJSON()
	}
}

// @Title DeleteSection
// @Summary deletes a section from form version
// @Description deletes a section from form version by taking section id as params
// @Security ApiKeyAuth
// @Param Authorization header string true "Authorization"
// @Accept	json
// @Param id                  path	int      true	"id"
// @Success	200	{string}	Section deleted successfully
// @Failure	400	Section not found
// @Failure	500	Internal Server Error
// @router /:id [delete]
func (s *SectionController) Delete() {
	if id, err := strconv.Atoi(s.Ctx.Input.Param(":id")); err != nil {
		if resp, err := json.Marshal(errors.NewHTTPError(err, http.StatusBadRequest, "Invalid section id")); err != nil {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusBadRequest)
			s.Ctx.ResponseWriter.Write(resp)
		}
	} else {
		if err = sections.DeleteSection(s.DB, id); err == nil {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
			s.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Section deleted successfully", nil)
			s.ServeJSON()
			return
		}
		if clientError, ok := err.(errors.ClientError); !ok {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if resp, err := clientError.ResponseBody(); err != nil {
			s.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			s.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			s.Ctx.ResponseWriter.Write(resp)
		}
	}
}
