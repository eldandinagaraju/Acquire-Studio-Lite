package models

import (
	"api/errors"
	"api/helpers"
	"database/sql"
	"net/http"
	"strconv"

	"github.com/beego/beego/v2/client/orm"
)

func PublishVersion(db *sql.DB, formID int, versionID int) error {
	o, err := orm.NewOrmWithDB("mysql", "default", db)
	if err != nil {
		return err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		qb.Update("form_versions").Set("is_published=0").Where("form_id=?")
		sql := qb.String()

		if _, err = o.Raw(sql, formID).Exec(); err != nil {
			return err
		}

		qb.Update("form_versions").Set("is_published=1").Where("id=?")
		sql = qb.String()
		
		if _, err = o.Raw(sql, versionID).Exec(); err != nil {
			return err
		}
	}
	return nil
}

// To get the form ID of given version ID
func GetFormID(db *sql.DB, versionID int) (int, error) {
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return -1, err
	}

	var formID int
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("form_id").From("form_versions").Where("id=?")
		sql := qb.String()
		if err := o.Raw(sql, versionID).QueryRow(&formID); err != nil {
			if err == orm.ErrNoRows {
				return -1, errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid version id")
			}
			return -1, err
		}
		return formID, nil
	}
}

// To get the last versionCode of a form
func GetLastVersionCode(db *sql.DB, formID int) (int, error) {
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return -1, err
	}

	var lastVersion string
	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("version_code").From("form_versions").Where("form_id=?").OrderBy("id").Desc().Limit(1)
		sql := qb.String()
		if err := o.Raw(sql, formID).QueryRow(&lastVersion); err != nil {
			if err == orm.ErrNoRows {
				return 0, nil
			}
			return -1, err
		} else if newVersionCode, err := strconv.Atoi(lastVersion[1:]); err != nil {
			return -1, err
		} else {
			return newVersionCode + 1, nil
		}
	}
}

// creates a new version for a form in form_versions table
func CreateVersion(db *sql.DB, formID int, versionCode int) (int64, error) {
	version_code := strconv.Itoa(versionCode)
	o, err := orm.NewOrmWithDB("mysql", "default", db)
	if err != nil {
		return 0, nil
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.InsertInto("form_versions", "version_uuid", "version_code", "is_published", "form_id").Values("?,?,?,?")
		sql := qb.String()
		if sqlResponse, err := o.Raw(sql, helpers.GenerateUUID(), "v"+version_code, 0, formID).Exec(); err != nil {
			return -1, err
		} else if lastEnteredID, err := sqlResponse.LastInsertId(); err != nil {
			return -1, err
		} else {
			return lastEnteredID, nil
		}
	}
}

func DeleteVersion(db *sql.DB, versionID int) error {
	o, err := orm.NewOrmWithDB("mysql", "default", db)
	if err != nil {
		return err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return err
	} else {
		qb.Update("form_versions").Set("row_status = 0").Where("id = ?")
		sql := qb.String()
		if _, err := o.Raw(sql, versionID).Exec(); err != nil {
			return err
		}
	}
	return nil
}
