// @APIVersion 1.0.0
// @Title beego Test API
// @Description beego has a very cool tools to autogenerate documents for your API
// @Contact astaxie@gmail.com
// @TermsOfServiceUrl http://beego.me/
// @License Apache 2.0
// @LicenseUrl http://www.apache.org/licenses/LICENSE-2.0.html
package routers

import (
	"api/controllers"
	"api/db"
	"fmt"
	"github.com/astaxie/beego"
	"log"
)

func init() {
	fmt.Println("routers")
	db, err := db.GetDBConnection()
	if err != nil {
		log.Printf("Error: %v", err)
	}
	ns := beego.NewNamespace("/api/v1",
		beego.NSNamespace("/login",
			beego.NSInclude(
				&controllers.LoginController{DB: db},
			)),
		beego.NSNamespace("/forms",
			beego.NSInclude(
				&controllers.FormController{DB: db},
			),
		),
		beego.NSNamespace("/sections",
			beego.NSInclude(
				&controllers.SectionController{DB: db},
			),
		),
		beego.NSNamespace("/version",
			beego.NSInclude(
				&controllers.FormVersion{DB: db},
			),
		),
		beego.NSNamespace("/questions",
			beego.NSInclude(
				&controllers.QuestionController{DB: db},
			),
		),
	)
	beego.AddNamespace(ns)
}
