package db

import (
	"database/sql"
	"fmt"
	"github.com/astaxie/beego"
	"github.com/beego/beego/v2/client/orm"
	_ "github.com/go-sql-driver/mysql"
	"os"
)

func init() {
	if beego.BConfig.RunMode == "dev" {
		orm.RegisterDriver("mysql", orm.DRMySQL)
		dbUser := os.Getenv("DB_USER")
		dbPasswd := os.Getenv("DB_PASSWORD")
		dbHost := os.Getenv("DB_HOST")
		dbName := os.Getenv("DB_NAME")
		dsn := fmt.Sprintf("%s:%s@tcp(%s:3306)/%s?charset=utf8", dbUser, dbPasswd, dbHost, dbName)
		orm.RegisterDataBase("default", "mysql", dsn)
	}
}

// to get a database connection
func GetDBConnection() (*sql.DB, error) {
	db, err := orm.GetDB()
	if err != nil {
		return nil, err
	}
	if err := db.Ping(); err != nil {
		return nil, err
	}
	return db, nil
}
