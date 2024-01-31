package sections

import (
	"api/errors"
	"api/models"
	"api/services"
	"database/sql"
	"encoding/json"
	"log"
	"net/http"
)

type CreateSectionSchema struct {
	VersionID int    `json:"versionId"`
	Title     string `json:"title"`
}

type CreateSectionResponseScheme struct {
	ID int64 `json:"id"`
}

type CreateSectionResponseSchema struct {
	ID int64 `json:"id"`
}

type SectionEditSchema struct {
	Title string `json:"title"`
}

// to get sections data for a form version
func GetAllSections(db *sql.DB, versionID int) ([]*models.SectionSchema, error) {
	if numberOfFormVersions, err := services.IsIdExistAndActive(db, "form_versions", versionID); err != nil {
		return nil, err
	} else if numberOfFormVersions == 0 {
		return nil, errors.NewHTTPError(err, http.StatusNotFound, "Version not found")
	}

	if response, err := models.GetSections(db, versionID); err != nil {
		return nil, err
	} else {
		return response, nil
	}
}

// to create a new section for a form version
func CreateSection(db *sql.DB, requestBody []byte) (CreateSectionResponseSchema, error) {
	var section CreateSectionSchema
	if err := json.Unmarshal(requestBody, &section); err != nil {
		return CreateSectionResponseSchema{}, errors.NewHTTPError(err, http.StatusBadRequest, "Invalid json")
	}

	if numberOfFormVersions, err := services.IsIdExistAndActive(db, "form_versions", section.VersionID); err != nil {
		return CreateSectionResponseSchema{}, err
	} else if numberOfFormVersions == 0 {
		return CreateSectionResponseSchema{}, errors.NewHTTPError(err, http.StatusBadRequest, "Version not found")
	}

	if err := SectionTitleValidation(db, section.Title, section.VersionID, -1); err != nil {
		return CreateSectionResponseSchema{}, err
	}

	if sectionID, err := models.CreateSection(db, section.VersionID, services.ConvertToTitle(section.Title)); err != nil {
		return CreateSectionResponseSchema{}, err
	} else {
		response := CreateSectionResponseSchema{ID: sectionID}
		return response, nil
	}
}

// to change the title of an existing section for a form version
func EditSection(db *sql.DB, requestBody []byte, id int) (SectionEditSchema, error) {
	var section SectionEditSchema
	if err := json.Unmarshal(requestBody, &section); err != nil {
		return SectionEditSchema{}, err
	}

	if numberOfSections, err := services.IsIdExist(db, "sections", id); err != nil {
		return SectionEditSchema{}, err
	} else if numberOfSections == 0 {
		return SectionEditSchema{}, errors.NewHTTPError(nil, http.StatusNotFound, "Section not found")
	}

	if numberOfSections, err := services.IsIdExistAndActive(db, "sections", id); err != nil {
		return SectionEditSchema{}, err
	} else if numberOfSections == 0 {
		return SectionEditSchema{}, errors.NewHTTPError(nil, http.StatusBadRequest, "Can not update this section")
	}

	if versionID, err := models.GetVersionID(db, id); err != nil {
		log.Printf("error %v", err)
		return SectionEditSchema{}, err
	} else if err := SectionTitleValidation(db, section.Title, versionID, id); err != nil {
		return SectionEditSchema{}, err
	}

	if err := models.EditSection(db, id, services.ConvertToTitle(section.Title)); err != nil {
		return SectionEditSchema{}, err
	}
	return section, nil
}

// to delete an existing section from a form version
func DeleteSection(db *sql.DB, id int) error {

	if numberOfSections, err := services.IsIdExist(db, "sections", id); err != nil {
		return err
	} else if numberOfSections == 0 {
		return errors.NewHTTPError(nil, http.StatusNotFound, "Section not found")
	}

	if err := models.DeleteSection(db, id); err != nil {
		return err
	}
	return nil
}
