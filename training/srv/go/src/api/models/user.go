package models

import (
	"database/sql"
	"github.com/beego/beego/v2/client/orm"
)

type Details struct {
	Email    string `orm:"column(username)" json:"email"`
	Password string `orm:"column(password)" json:"password"`
}


// retrieve the username and password for a particular username from users table
func GetUserData(db *sql.DB, email string) (*Details, error) {
	var credential Details
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return nil, err
	} else {
		qb.Select("username", "password").From("users").Where("username = ?")
		sql := qb.String()
		o, err := orm.NewOrmWithDB("mysql", "default", db)
		if err != nil {
			return nil, err
		}
		if err = o.Raw(sql, email).QueryRow(&credential); err != nil {
			return nil, err
		}
		return &credential, nil
	}
}
