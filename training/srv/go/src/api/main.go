package main

import (
	"log"

	"api/middlewares"
	_ "api/routers"

	// _ "github.com/dbohachev/beego-swagger"
	"github.com/astaxie/beego"
	"github.com/astaxie/beego/plugins/cors"
	"github.com/beego/beego/v2/client/orm"
	// _"github.com/swaggo/http-swagger"
)

func init() {
	CorsInit()
}

// @securityDefinitions.apikey ApiKeyAuth
// @in header
// @name Authorization
func main() {
	orm.Debug = true
	log.Println("Starting the server")
	beego.BConfig.WebConfig.DirectoryIndex = true
	beego.BConfig.WebConfig.StaticDir["/swagger"] = "swagger"
	beego.RunWithMiddleWares(":8080", middlewares.JwtMiddleware)
}

func CorsInit() {
	beego.InsertFilter("*", beego.BeforeRouter, cors.Allow(&cors.Options{
		AllowAllOrigins:  true,
		AllowOrigins:     []string{"*"},
		AllowMethods:     []string{"GET", "POST", "PUT", "DELETE", "PATCH"},
		AllowHeaders:     []string{"Content-Type", "Origin", "Authorization", "Access-Control-Allow-Methods"},
		ExposeHeaders:    []string{"Content-Length", "Origin", "Access-Control-Allow-Methods"},
		AllowCredentials: true,
	}))
}
