package controllers

import (
	"api/errors"
	"api/helpers"
	"api/services/form_version"
	"database/sql"
	"encoding/json"
	"github.com/astaxie/beego"
	"log"
	"net/http"
	"strconv"
)

type FormVersion struct {
	beego.Controller
	DB *sql.DB
}

// @Title PublishVersion
// @Summary publishes a version of the form
// @Description publishes a form version by updating the is_published column in form_versions table
// @Security ApiKeyAuth
// @Accept	json
// @Param Authorization header string true "Authorization"
// @Param request body form_version.PublishVersionSchema true "query params"
// @Success	200	{string} Version published successfully
// @Failure	400	Version not found
// @Failure	500	Internal Server Error
// @router / [put]
func (fv *FormVersion) Put() {
	if err := form_version.PublishVersion(fv.DB, fv.Ctx.Input.RequestBody); err != nil {
		log.Println("Error : " + err.Error())
		if clientError, ok := err.(errors.ClientError); !ok {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err != nil {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			fv.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			fv.Ctx.ResponseWriter.Write(body)
		}
	} else {
		fv.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
		fv.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Version published successfully", nil)
		fv.ServeJSON()
	}
}

// @Title CreateVersion
// @Summary creates a new version for a form
// @Description creates a new version for a form in form_versions table by taking form id as params
// @Security ApiKeyAuth
// @Accept	json
// @Param Authorization header string true "Authorization"
// @Param request body form_version.CreateVersionSchema true "query params"
// @Success	201	{object}	form_version.CreateVersionResponseSchema
// @Failure	400	Form not found
// @Failure	500	Internal Server Error
// @router / [post]
func (fv *FormVersion) Post() {
	if response, err := form_version.CreateVersion(fv.DB, fv.Ctx.Input.RequestBody); err != nil {
		if clientError, ok := err.(errors.ClientError); !ok {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err != nil {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			fv.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			fv.Ctx.ResponseWriter.Write(body)
		}
	} else {
		fv.Data["json"] = helpers.SuccessResponse(http.StatusCreated, "Version created successfully", response)
		fv.Ctx.ResponseWriter.WriteHeader(http.StatusCreated)
		fv.ServeJSON()
	}
}

// @Title DeleteVersion
// @Summary deletes a version of a form
// @Description deletes a version of a form from form_versions table by taking version id as params
// @Security ApiKeyAuth
// @Accept	json
// @Param Authorization header string true "Authorization"
// @Param   id    path   int 	true  "id"
// @Success	200	{string}	Form version deleted successfully
// @Failure	400	Version not found
// @Failure	500	Internal Server Error
// @router /:id [delete]
func (fv *FormVersion) Delete() {
	if versionID, err := strconv.Atoi(fv.Ctx.Input.Param(":id")); err != nil {
		if resp, err := json.Marshal(errors.NewHTTPError(err, http.StatusBadRequest, "Invalid version id")); err != nil {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusBadRequest)
			fv.Ctx.ResponseWriter.Write(resp)
		}
		return
	} else {
		if err := form_version.DeleteVersion(fv.DB, versionID); err == nil {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
			fv.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Form version deleted successfully", nil)
			fv.ServeJSON()
			return
		}
		if clientError, ok := err.(errors.ClientError); !ok {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if resp, err := clientError.ResponseBody(); err != nil {
			fv.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			fv.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			fv.Ctx.ResponseWriter.Write(resp)
		}
	}
}
