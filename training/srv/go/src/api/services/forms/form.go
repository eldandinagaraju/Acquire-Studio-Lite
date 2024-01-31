package forms

import (
	"api/errors"
	"api/models"
	"api/services"
	"database/sql"
	"encoding/json"
	"log"
	"net/http"
)

type FormVersionSchema struct {
	VersionID   int    `json:"versionID"`
	VersionCode string `json:"versionCode"`
	IsPublished bool   `json:"isPublished"`
}

type FormSchema struct {
	FormID   int                  `json:"id"`
	Title    string               `json:"title"`
	Versions []*FormVersionSchema `json:"versions"`
}

type CreateFormSchema struct {
	Title string `json:"title"`
}

type DeleteFormSchema struct {
	ID int `json:"id"`
}

type EditFormSchema struct {
	Title string `json:"title"`
}

type CreateFormResponseSchema struct {
	ID int64 `json:"id"`
}

// to create a new form
func CreateForm(db *sql.DB, requestBody []byte) (CreateFormResponseSchema, error) {
	var createFormSchema CreateFormSchema
	if err := json.Unmarshal(requestBody, &createFormSchema); err != nil {
		return CreateFormResponseSchema{}, errors.NewHTTPError(err, 400, "Invalid json")
	}

	if err := services.IsTitleValid(createFormSchema.Title); err != nil {
		log.Printf("error : %v", err)
		return CreateFormResponseSchema{}, errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid form title.")
	} else if formTitleCount, err := models.IsFormTitleExist(db, createFormSchema.Title, -1); err != nil {
		return CreateFormResponseSchema{}, err
	} else if formTitleCount != 0 {
		return CreateFormResponseSchema{}, errors.NewHTTPError(nil, http.StatusBadRequest, "'"+createFormSchema.Title+"' already exists")
	}

	if formID, err := models.CreateForm(db, createFormSchema.Title); err != nil {
		return CreateFormResponseSchema{}, err
	} else {
		response := CreateFormResponseSchema{ID: formID}
		return response, nil
	}
}

// to delete an existing form
func DeleteForm(db *sql.DB, id int) error {

	if numberOfForms, err := services.IsIdExist(db, "forms", id); err != nil {
		return err
	} else if numberOfForms == 0 {
		return errors.NewHTTPError(nil, http.StatusNotFound, "Form id does not exist")
	}

	if err := models.DeleteForm(db, id); err != nil {
		return err
	}
	return nil
}

// to change the form title of an existing form
func EditForm(db *sql.DB, requestBody []byte, id int) error {
	var form EditFormSchema
	if err := json.Unmarshal(requestBody, &form); err != nil {
		return errors.NewHTTPError(err, http.StatusBadRequest, "Invalid json")
	}

	if err := services.IsTitleValid(form.Title); err != nil {
		log.Printf("error : %v", err)
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Invalid form title.")
	}
	if numberOfForms, err := services.IsIdExist(db, "forms", id); err != nil {
		log.Printf("An Error Occurred : %v", err)
		return err
	} else if numberOfForms == 0 {
		return errors.NewHTTPError(nil, http.StatusNotFound, "Form not found")
	}

	if numberOfForms, err := services.IsIdExistAndActive(db, "forms", id); err != nil {
		return err
	} else if numberOfForms == 0 {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "Can not update this form")
	}

	if formTitleCount, err := models.IsFormTitleExist(db, form.Title, id); err != nil {
		return err
	} else if formTitleCount != 0 {
		return errors.NewHTTPError(nil, http.StatusBadRequest, "'"+form.Title+"' already exists")
	}

	if err := models.EditForm(db, id, form.Title); err != nil {
		return err
	}
	return nil
}

// to get all forms data along with their versions
func GetForms(db *sql.DB) ([]*FormSchema, error) {
	formJoinVersionsList, err := models.GetAllForms(db)
	var FormsList []*FormSchema
	if err != nil {
		return FormsList, err
	}

	formIDToFormMap := make(map[int]*FormSchema)
	for _, row := range formJoinVersionsList {
		if val, ok := formIDToFormMap[row.FormID]; !ok {
			if row.VersionID == 0 {
				formIDToFormMap[row.FormID] = &FormSchema{
					FormID:   row.FormID,
					Title:    row.Title,
					Versions: []*FormVersionSchema{}}
			} else {
				formIDToFormMap[row.FormID] = &FormSchema{
					FormID: row.FormID,
					Title:  row.Title,
					Versions: []*FormVersionSchema{
						{
							VersionID:   row.VersionID,
							VersionCode: row.VersionCode,
							IsPublished: row.IsPublished,
						},
					},
				}
			}
			FormsList = append(FormsList, formIDToFormMap[row.FormID])
		} else {
			val.Versions = append(val.Versions, &FormVersionSchema{
				VersionID:   row.VersionID,
				VersionCode: row.VersionCode,
				IsPublished: row.IsPublished,
			})
		}
	}
	return FormsList, nil
}
