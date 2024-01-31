package models

import (
	"api/helpers"
	"database/sql"
	"fmt"
	"log"
	"time"

	"github.com/beego/beego/v2/client/orm"
)

type FormDetails struct {
	ID        int    `orm:"column(id);pk"`
	FormUUID  string `orm:"column(form_uuid)"`
	Title     string
	CreatedAt time.Time `orm:"column(created_at);auto_now_add;type(datetime)"`
	UpdatedAt time.Time `orm:"column(updated_at);auto_now;type(datetime)"`
}

// creates a new form in the forms table
func CreateForm(db *sql.DB, title string) (int64, error) {
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return 0, err
	} else {
		qb.InsertInto("forms", "title", "form_uuid").Values("?", "?")
		sql := qb.String()
		if o, err := orm.NewOrmWithDB("mysql", "default", db); err != nil {
			return 0, err
		} else if sqlResponse, err := o.Raw(sql, title, helpers.GenerateUUID()).Exec(); err != nil {
			return 0, err
		} else if lastInsertedID, err := sqlResponse.LastInsertId(); err != nil {
			return 0, err
		} else {
			return lastInsertedID, nil
		}
	}
}

// check whether the form title exists or not in the database
func IsFormTitleExist(db *sql.DB, title string, id int) (int, error) {
	o, err := orm.NewOrmWithDB("mysql", "default", db)
	if err != nil {
		return 0, err
	}
	var count int
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("COUNT(*)").From("forms").Where("title=?").And("row_status=1").And("id!=?")
		sql := qb.String()

		if err := o.Raw(sql, title, id).QueryRow(&count); err != nil {
			return -1, err
		}
		return count, nil
	}
}

// deletes a form from the forms table
func DeleteForm(db *sql.DB, formID int) error {
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {

		qb.Update("forms").Set("row_status=0").Where("id = ?")
		sql := qb.String()

		o, err := orm.NewOrmWithDB("mysql", "default", db)

		if err != nil {
			return err
		}

		_, err = o.Raw(sql, formID).Exec()
		if err != nil {
			log.Printf("cannot get sql response , there is an sql error : %v", err)
			return err
		}
		return nil
	}
}

// changes the title of a form in the forms table
func EditForm(db *sql.DB, formID int, title string) error {
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		qb.Update("forms").Set("title = ?").Where("id = ?")
		sql := qb.String()
		o, err := orm.NewOrmWithDB("mysql", "default", db)
		if err != nil {
			return err
		}
		if _, err := o.Raw(sql, title, formID).Exec(); err != nil {
			return err
		}
		return nil
	}
}

type FormJoinVersionSchema struct {
	FormID      int    `orm:"column(id)" json:"id"`
	Title       string `orm:"column(title)" json:"title"`
	VersionID   int    `orm:"column(version_id)" json:"versionID"`
	VersionCode string `orm:"column(version_code)" json:"versionCode"`
	IsPublished bool   `orm:"column(is_published)" json:"isPublished"`
}

func (f FormJoinVersionSchema) String() string {
	return fmt.Sprintf("Form ID: %d\tTitle: %s\tVersion ID: %d\tVersion Code: %s\tIs Published: %v\n",
		f.FormID, f.Title, f.VersionID, f.VersionCode, f.IsPublished)
}

// retrieves the forms and versions data by joining forms and versions tables
func GetAllForms(db *sql.DB) ([]*FormJoinVersionSchema, error) {
	var formJoinVersionsList []*FormJoinVersionSchema

	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return nil, err
	}

	qb, err := orm.NewQueryBuilder("mysql")

	if err != nil {
		return nil, err
	}

	qb.Select("forms.id, forms.title, form_versions.id as version_id, form_versions.version_code, form_versions.is_published").
		From("forms").LeftJoin("form_versions").
		On("forms.id = form_versions.form_id").
		Where("forms.row_status=1 and (form_versions.row_status IS NULL or form_versions.row_status = 1)").
		OrderBy("id", "version_id")

	queryString := qb.String()

	_, err = o.Raw(queryString).QueryRows(&formJoinVersionsList)

	if err != nil {
		return nil, err
	}
	return formJoinVersionsList, nil
}
