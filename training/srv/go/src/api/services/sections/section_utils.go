package sections

import (
	"api/errors"
	"api/models"
	"api/services"
	"database/sql"
	"log"
	"net/http"
	"strings"
)

// Validate Section Title
func SectionTitleValidation(db *sql.DB, title string, versionID int, currentSectionID int) error {

	if err := services.IsTitleValid(title); err != nil {
		log.Printf("error : %v", err)
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid section title.")
	}

	if err := models.IsSectionTitleExist(db, versionID, LowerCaseAndTrim(title), currentSectionID); err != nil {
		return err
	} else {
		return nil
	}
}

// Removes white spaces between the strings
func LowerCaseAndTrim(title string) string {
	return strings.Trim(strings.ToLower(title), " ")
}
