package controllers

import (
	"api/errors"
	"api/helpers"
	"api/services/user"
	"database/sql"
	"net/http"

	"github.com/astaxie/beego"
)

type LoginController struct {
	beego.Controller
	DB *sql.DB
}

// @Title UserLogin
// @Summary user is logged in and jwt token will be generated
// @Description user is logged in after successfull validation of credentials
// @Security ApiKeyAuth
// @Accept	json
// @Param request body user.LoginRequestSchema true "query params"
// @Success	200	{object}	user.LoginResponseSchema
// @Failure	400	Invalid username or password
// @Failure	500	Internal Server Error
// @router / [post]
func (l *LoginController) Post() {
	if response, err := user.ValidateUser(l.DB, l.Ctx.Input.RequestBody); err != nil {
		if clientError, ok := err.(errors.ClientError); !ok {
			l.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else if body, err := clientError.ResponseBody(); err != nil {
			l.Ctx.ResponseWriter.WriteHeader(http.StatusInternalServerError)
		} else {
			l.Ctx.ResponseWriter.WriteHeader(clientError.ResponseCode())
			l.Ctx.ResponseWriter.Write(body)
		}
	} else {
		l.Ctx.ResponseWriter.WriteHeader(http.StatusOK)
		l.Data["json"] = helpers.SuccessResponse(http.StatusOK, "Logged in successfully", response)
		l.ServeJSON()
	}
}
