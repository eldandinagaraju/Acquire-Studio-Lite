package controllers

import (
	"api/errors"
	"api/helpers"
	"api/services/forms"
	"database/sql"
	"log"
	"net/http"
	"strconv"

	"github.com/astaxie/beego"
)

type FormController struct {
	beego.Controller
	DB *sql.DB
}

// @Title CreateForm
// @Summary creates a form in forms table
// @Description creates a form by taking the form title as params
// @Accept	json
// @Security ApiKeyAuth
// @Param Authorization header string true "Authorization"
// @Param request body forms.CreateFormSchema true "query params"
// @Success	201	{object} forms.CreateFormResponseSchema
// @Failure	400	Form title should not be empty
// @Failure	500	Internal Server Error
// @router / [post]
func (f *FormController) Post() {

	response, err := forms.CreateForm(f.DB, f.Ctx.Input.RequestBody)

	f.Ctx.Output.Header("Content-Type", "application/json")

	if err == nil {
		f.Data["json"] = helpers.SuccessResponse(http.StatusCreated, "form successfuly created", response)
		f.Ctx.ResponseWriter.WriteHeader(http.StatusCreated)
		f.ServeJSON()
	} else {
		if clientError, ok := err.(errors.ClientError); !ok {
			f.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err != nil {
			f.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			f.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			f.Ctx.ResponseWriter.Write(body)
		}
	}
}

// @Title DeleteForm
// @Summary deletes a form from forms table
// @Description deletes a form by taking the formID as params
// @Security ApiKeyAuth
// @Accept	json
// @Param Authorization header string true "Authorization"
// @Param request body forms.DeleteFormSchema true "query params"
// @Success	200	{string} Form deleted successfully
// @Failure	400	Form id does not exist
// @Failure	500	Internal Server Error
// @router /:id [delete]
func (d *FormController) Delete() {

	strID := d.Ctx.Input.Param(":id")
	id, err := strconv.Atoi(strID)

	if err != nil {
		log.Println("Error occurred while converting the string id to and int")
		d.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		return
	}

	err = forms.DeleteForm(d.DB, id)

	if err == nil {
		d.Ctx.ResponseWriter.WriteHeader(http.StatusNoContent)
		d.ServeJSON()
	} else {
		if clientError, ok := err.(errors.ClientError); !ok {
			d.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err != nil {
			d.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			d.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			d.Ctx.ResponseWriter.Write(body)
		}
	}
}

// @Title EditForm
// @Summary changes the title of a form
// @Description changes the title of a form in the forms table by taking the formID and new form title as params
// @Security ApiKeyAuth
// @Accept	json
// @Param Authorization header string true "Authorization"
// @Param request body forms.EditFormSchema true "query params"
// @Success	200	{string} Form title updated successfully
// @Failure	400	Form not found
// @Failure	500	Internal Server Error
// @router /:id [patch]
func (f *FormController) Patch() {
	username := f.Ctx.Request.Context().Value(helpers.ContextKey("username")).(string)

	if username == "" {
		log.Println("Error : Username cannot be blank.")
		f.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		return
	}

	strID := f.Ctx.Input.Param(":id")
	id, err := strconv.Atoi(strID)

	if err != nil {
		log.Println("Error occurred while converting the string id to and int")
		f.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		return
	}

	err = forms.EditForm(f.DB, f.Ctx.Input.RequestBody, id)

	if err == nil {
		f.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
		f.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Form title updated successfully", nil)
		f.ServeJSON()
	} else {
		if clientError, ok := err.(errors.ClientError); !ok {
			f.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err != nil {
			f.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			f.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			f.Ctx.ResponseWriter.Write(body)
		}
	}
}

// @Title GetForms
// @Summary fetches the forms data along with the versions
// @Description fetches all forms present in the forms table along with versions from form_versions table
// @Security ApiKeyAuth
// @Accept	json
// @Param Authorization header string true "Authorization"
// @Success	200	{object} forms.FormSchema
// @Failure	500	Internal Server Error
// @router / [get]
func (f *FormController) Get() {
	if forms, err := forms.GetForms(f.DB); err != nil {
		f.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
	} else {
		f.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
		f.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Success", forms)
		f.ServeJSON()
	}
}
