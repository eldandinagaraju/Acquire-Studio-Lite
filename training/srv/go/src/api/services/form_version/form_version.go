package form_version

import (
	"api/errors"
	"api/models"
	"api/services"
	"database/sql"
	"encoding/json"
	"net/http"
	"strconv"
)

type PublishVersionSchema struct {
	VersionID int `json:"versionID"`
}

type CreateVersionResponseSchema struct {
	ID          int64  `json:"id"`
	VersionCode string `json:"versionCode"`
}

type CreateVersionSchema struct {
	ID int `json:"formID"`
}

// to publish an existing version of the form
func PublishVersion(db *sql.DB, requestBody []byte) error {
	var publishVersionSchema PublishVersionSchema
	if err := json.Unmarshal(requestBody, &publishVersionSchema); err != nil {
		return errors.NewHTTPError(err, http.StatusBadRequest, "Invalid json")
	}

	if numberOfVersions, err := services.IsIdExist(db, "form_versions", publishVersionSchema.VersionID); err != nil {
		return err
	} else if numberOfVersions == 0 {
		return errors.NewHTTPError(err, http.StatusNotFound, "Version not found")
	}

	if numberOfVersions, err := services.IsIdExistAndActive(db, "form_versions", publishVersionSchema.VersionID); err != nil {
		return err
	} else if numberOfVersions == 0 {
		return errors.NewHTTPError(err, http.StatusBadRequest, "Can not publish this version")
	}

	if formID, err := models.GetFormID(db, publishVersionSchema.VersionID); err != nil {
		return err
	} else {
		if err = models.PublishVersion(db, formID, publishVersionSchema.VersionID); err != nil {
			return err
		}
	}
	return nil
}

// to create a new version for a form
func CreateVersion(db *sql.DB, requestBody []byte) (CreateVersionResponseSchema, error) {
	var version CreateVersionSchema
	var response CreateVersionResponseSchema
	var versionCode int
	if err := json.Unmarshal(requestBody, &version); err != nil {
		return CreateVersionResponseSchema{}, err
	}

	if numberOfForms, err := services.IsIdExist(db, "forms", version.ID); err != nil {
		return CreateVersionResponseSchema{}, err
	} else if numberOfForms == 0 {
		return CreateVersionResponseSchema{}, errors.NewHTTPError(nil, http.StatusBadRequest, "Form not found")
	} else if versionCode, err = models.GetLastVersionCode(db, version.ID); err != nil {
		return CreateVersionResponseSchema{}, err
	}

	if versionID, err := models.CreateVersion(db, version.ID, versionCode); err != nil {
		return CreateVersionResponseSchema{}, err
	} else {
		response = CreateVersionResponseSchema{
			ID:          versionID,
			VersionCode: "v" + strconv.Itoa(versionCode),
		}
		return response, nil
	}
}

// to delete an existing version from a form
func DeleteVersion(db *sql.DB, versionID int) error {
	if numberOfVersions, err := services.IsIdExist(db, "form_versions", versionID); err != nil {
		return err
	} else if numberOfVersions == 0 {
		return errors.NewHTTPError(nil, http.StatusNotFound, "Version not found")
	}

	if err := models.DeleteVersion(db, versionID); err != nil {
		return err
	}
	return nil
}
