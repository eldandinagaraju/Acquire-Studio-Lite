package models

import (
	"api/errors"
	"api/helpers"
	"database/sql"
	"log"
	"net/http"

	"github.com/beego/beego/v2/client/orm"
)

type SectionSchema struct {
	ID    int    `orm:"column(id);auto" json:"id"`
	Title string `orm:"column(title)" json:"title"`
}

// to check whether a section title already exists in the sections table
func IsSectionTitleExist(db *sql.DB, versionID int, sectionTitle string, currentSectionID int) error {
	o, err := orm.NewOrmWithDB("mysql", "default", db)
	if err != nil {
		return err
	}

	qb, err := orm.NewQueryBuilder("mysql")

	if err != nil {
		return err
	}

	qb.Select("COUNT(*) as count").
		From("sections").
		Where("version_id=?").
		And("TRIM(LOWER(title))=?").
		And("row_status=1").
		And("id!=?")

	var count int
	err = o.Raw(qb.String(), versionID, sectionTitle, currentSectionID).QueryRow(&count)

	if err != nil {
		return err
	}
	log.Print(count)

	if count != 0 {
		return errors.NewHTTPError(err, http.StatusBadRequest, "'"+sectionTitle+"' already exists")
	}

	return nil
}

// to retrieve the sections data of a version from sections table
func GetSections(db *sql.DB, id int) ([]*SectionSchema, error) {
	var sectionSchema []*SectionSchema

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return []*SectionSchema{}, err
	} else {
		o, err := orm.NewOrmWithDB("mysql", "default", db)
		if err != nil {
			return []*SectionSchema{}, err
		}

		qb.Select("id,title").From("sections").Where("version_id=?").And("row_status=1")
		if _, err = o.Raw(qb.String(), id).QueryRows(&sectionSchema); err != nil {
			return sectionSchema, err
		}
		return sectionSchema, nil
	}
}

// creates a new section in a form version by inserting section data in sections table
func CreateSection(db *sql.DB, id int, title string) (int64, error) {
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return 0, err
	} else {
		o, err := orm.NewOrmWithDB("mysql", "default", db)
		if err != nil {
			return 0, err
		}

		qb.InsertInto("sections", "section_uuid", "version_id", "title").Values("?", "?", "?")
		if sqlResponse, err := o.Raw(qb.String(), helpers.GenerateUUID(), id, title).Exec(); err != nil {
			return 0, err
		} else if lastInsertedID, err := sqlResponse.LastInsertId(); err != nil {
			return 0, err
		} else {
			return lastInsertedID, nil
		}
	}
}

// get the versionID of particular a section from sections table
func GetVersionID(db *sql.DB, sectionID int) (int, error) {
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return -1, err
	}

	var versionID int
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("version_id").From("sections").Where("id=?")
		sql := qb.String()
		if err = o.Raw(sql, sectionID).QueryRow(&versionID); err != nil {
			return -1, err
		}
		return versionID, nil
	}
}

// changes the title of a section in sections table
func EditSection(db *sql.DB, sectionID int, title string) error {
	o, err := orm.NewOrmWithDB("mysql", "default", db)
	if err != nil {
		return err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		qb.Update("sections").Set("title=?").Where("id=?")
		sql := qb.String()
		if _, err := o.Raw(sql, title, sectionID).Exec(); err != nil {
			return err
		}
		return nil
	}
}

func DeleteSection(db *sql.DB, id int) error {
	o, err := orm.NewOrmWithDB("mysql", "default", db)
	if err != nil {
		return err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		qb.Update("sections").Set("row_status=0").Where("id=?")
		sql := qb.String()
		if _, err := o.Raw(sql, id).Exec(); err != nil {
			return err
		}
	}
	return nil
}
