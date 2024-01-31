package forms

import (
	"encoding/json"
	"fmt"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/stretchr/testify/assert"
)

func TestCreateForm(t *testing.T) {
	db, mock, err := sqlmock.New()
	if err != nil {
		t.Fatalf("an error '%s' was not expected when opening a stub database connection", err)
	}
	defer db.Close()

	type vars struct {
		Title string `json:"title"`
	}
	testCases := []struct {
		name   string
		vars   vars
		dbmock func(sqlmock.Sqlmock)
		hasErr bool
		err    string
	}{
		{
			name: "should fail since title is empty",
			vars: vars{
				Title: "",
			},
			hasErr: true,
			err:    "Invalid form title.",
		},
		{
			name: "should fail since form title already exists",
			vars: vars{
				Title: "New Form Title",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE title=\? AND row_status=1 AND id!=\?`).WithArgs("New Form Title", -1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
			},
			hasErr: true,
			err:    "'New Form Title' already exists",
		},
		{
			name: "should fail since sql error in IsFormTitleExist",
			vars: vars{
				Title: "New Form Title",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE title=\? AND row_status=1 AND id!=\?`).WithArgs("New Form Title", -1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should fail since sql error in CreateForm model",
			vars: vars{
				Title: "New Form Title",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE title=\? AND row_status=1 AND id!=\?`).WithArgs("New Form Title", -1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
				mock.ExpectExec(`INSERT INTO forms \( title, form_uuid \) VALUES \( \?, \? \)`).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should pass",
			vars: vars{
				Title: "New Form Title",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE title=\? AND row_status=1 AND id!=\?`).WithArgs("New Form Title", -1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
				mock.ExpectExec(`INSERT INTO forms \( title, form_uuid \) VALUES \( \?, \? \)`).WillReturnResult(sqlmock.NewResult(1, 1))
			},
			hasErr: false,
		},
	}
	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.dbmock != nil {
				tCase.dbmock(mock)
			}
			res, err := json.Marshal(tCase.vars)
			if err != nil {
				tt.Fatalf("Error")
			}
			_, err = CreateForm(db, res)

			if tCase.hasErr {
				assert.Equal(tt, err.Error(), tCase.err)
			} else if err != nil {
				tt.Fatalf("An Unknown Error occurred which should not come , error : %v", err)
			}
		})
	}
}

func TestDeleteForm(t *testing.T) {
	db, mock, err := sqlmock.New()
	if err != nil {
		t.Fatalf("an error '%s' was not expected when opening a stub database connection", err)
	}
	defer db.Close()

	type vars struct {
		Id int `json:"id"`
	}
	testCases := []struct {
		name   string
		vars   vars
		dbmock func(sqlmock.Sqlmock)
		hasErr bool
		err    string
	}{
		{
			name: "should fail since invalid form ID",
			vars: vars{
				Id: 1,
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
			},
			hasErr: true,
			err:    "Form id does not exist",
		},
		{
			name: "should fail since sql error in isIdExist",
			vars: vars{
				Id: 1,
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should fail since sql error in DeleteForm model",
			vars: vars{
				Id: 1,
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectExec(`UPDATE forms SET row_status=0 WHERE id = \?`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should pass",
			vars: vars{
				Id: 1,
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectExec(`UPDATE forms SET row_status=0 WHERE id = \?`).WithArgs(1).WillReturnResult(sqlmock.NewResult(1, 1))
			},
			hasErr: false,
		},
	}
	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.dbmock != nil {
				tCase.dbmock(mock)
			}
			err = DeleteForm(db, tCase.vars.Id)
			if tCase.hasErr {
				assert.Equal(tt, err.Error(), tCase.err)
			} else if err != nil {
				tt.Fatalf("An Unknown Error occured which should not come , error : %v", err)
			}
		})
	}
}

func TestEditForm(t *testing.T) {
	db, mock, err := sqlmock.New()
	if err != nil {
		t.Fatalf("an error '%s' was not expected when opening a stub database connection", err)
	}
	defer db.Close()

	type vars struct {
		Id    int    `json:"id"`
		Title string `json:"title"`
	}
	testCases := []struct {
		name   string
		vars   vars
		dbmock func(sqlmock.Sqlmock)
		hasErr bool
		err    string
	}{
		{
			name: "should fail since invalid form ID",
			vars: vars{
				Id:    1,
				Title: "UpdatedTitle",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
			},
			hasErr: true,
			err:    "Form not found",
		},
		{
			name: "should fail since sql error in isIdExist",
			vars: vars{
				Id:    1,
				Title: "UpdatedTitle",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should fail since form title already exist",
			vars: vars{
				Id:    1,
				Title: "Form title 1",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\? and row_status != 0`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE title=\? AND row_status=1 AND id!=\?`).WithArgs("Form title 1", 1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
			},
			hasErr: true,
			err:    "'Form title 1' already exists",
		},
		{
			name: "should fail since sql error in isFormTitleExist",
			vars: vars{
				Id:    1,
				Title: "New Form Title",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\? and row_status != 0`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE title=\? AND row_status=1 AND id!=\?`).WithArgs("New Form Title", 1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should fail since sql error in models",
			vars: vars{
				Id:    3,
				Title: "New Form Title",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(3).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\? and row_status != 0`).WithArgs(3).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE title=\? AND row_status=1 AND id!=\?`).WithArgs("New Form Title", 3).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
				mock.ExpectExec(`UPDATE forms SET title = \? WHERE id = \?`).WithArgs("New Form Title", 3).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should pass",
			vars: vars{
				Id:    3,
				Title: "New Form Title",
			},
			dbmock: func(s sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\?`).WithArgs(3).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE id=\? and row_status != 0`).WithArgs(3).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM forms WHERE title=\? AND row_status=1 AND id!=\?`).WithArgs("New Form Title", 3).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
				mock.ExpectExec(`UPDATE forms SET title = \? WHERE id = \?`).WithArgs("New Form Title", 3).WillReturnResult(sqlmock.NewResult(1, 1))
			},
			hasErr: false,
		},
	}
	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.dbmock != nil {
				tCase.dbmock(mock)
			}

			ID := tCase.vars.Id
			Title := tCase.vars.Title

			res, err := json.Marshal(EditFormSchema{Title: Title})

			if err != nil {
				tt.Fatalf("Error")
			}

			err = EditForm(db, res, ID)

			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				tt.Fatalf("An Unknown Error occurred which should not come , error : %v", err)
			}
		})
	}
}

func TestGetForms(t *testing.T) {
	db, mock, err := sqlmock.New()
	if err != nil {
		t.Fatalf("an error '%s' was not expected when opening a stub database connection", err)
	}
	defer db.Close()
	testCases := []struct {
		name   string
		dbmock func(sqlmock.Sqlmock)
		hasErr bool
		err    string
		want   []*FormSchema
	}{
		{
			name: "should pass",
			dbmock: func(s sqlmock.Sqlmock) {
				row := sqlmock.NewRows([]string{"id", "title", "version_id", "version_code", "is_published"}).AddRow(1, "Test Title 1", 1, "0", true).AddRow(1, "Test Title 1", 2, "0", false).AddRow(2, "Test Title 2", 0, nil, nil)
				mock.ExpectQuery(`SELECT forms.id, forms.title, form_versions.id as version_id, form_versions.version_code, form_versions.is_published FROM forms LEFT JOIN form_versions ON forms.id = form_versions.form_id WHERE forms.row_status=1 and \(form_versions.row_status IS NULL or form_versions.row_status = 1\) ORDER BY id, version_id`).WillReturnRows(row)
			},
			hasErr: false,
			want: []*FormSchema{{
				FormID: 1,
				Title:  "NewTitle",
				Versions: []*FormVersionSchema{
					{1, "0", true},
					{2, "0", false},
				},
			}},
		},
		{
			name: "should pass",
			dbmock: func(s sqlmock.Sqlmock) {
				row := sqlmock.NewRows([]string{"title", "form_versions.id", "form_versions.is_published", "row_status"}).AddRow("NewTitle", 1, 0, 1)
				mock.ExpectQuery(`SELECT forms.id, forms.title, form_versions.id as version_id, form_versions.version_code, form_versions.is_published FROM forms LEFT JOIN form_versions ON forms.id = form_versions.form_id WHERE forms.row_status=1 and \(form_versions.row_status IS NULL or form_versions.row_status = 1\) ORDER BY id, version_id`).WillReturnRows(row)
			},
			hasErr: false,
		},
		{
			name: "should fail when orm.Raw returns an error",
			dbmock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT forms.id, forms.title, form_versions.id as version_id, form_versions.version_code, form_versions.is_published FROM forms LEFT JOIN form_versions ON forms.id = form_versions.form_id WHERE forms.row_status=1 and \(form_versions.row_status IS NULL or form_versions.row_status = 1\) ORDER BY id, version_id`).WithArgs().WillReturnError(fmt.Errorf("some error"))
			},
			hasErr: true,
			err:    "some error",
		},
	}
	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.dbmock != nil {
				tCase.dbmock(mock)
			}
			_, err = GetForms(db)
			if tCase.hasErr {
				assert.Equal(tt, err.Error(), tCase.err)
			} else if err != nil {
				tt.Fatalf("An Unknown Error occured which should not come , error : %v", err)
			}
		})
	}
}
