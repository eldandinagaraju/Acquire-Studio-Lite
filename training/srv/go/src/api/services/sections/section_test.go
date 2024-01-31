package sections

import (
	"api/models"
	"encoding/json"
	"fmt"
	"testing"

	"github.com/DATA-DOG/go-sqlmock"
	"github.com/stretchr/testify/assert"
)

func TestGetAllSections(t *testing.T) {
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
		mock   func(sqlmock.Sqlmock)
		hasErr bool
		err    string
		want   []*models.SectionSchema
	}{
		{
			name: "should fail since sql error in IsIdExist",
			vars: vars{
				Id: 1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\?`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should fail since version id does not exist",
			vars: vars{
				Id: 1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
			},
			hasErr: true,
			err:    "Version not found",
		},
		{
			name: "should fail since sql error in model GetSection function",
			vars: vars{
				Id: 1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT id,title FROM sections WHERE version_id=\? AND row_status=1`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should pass",
			vars: vars{
				Id: 1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				row := sqlmock.NewRows([]string{"id", "title", "version_id", "row_status"}).AddRow(1, "Test Section 1", 1, 1).AddRow(1, "Test Title 2", nil, nil)
				mock.ExpectQuery(`SELECT id,title FROM sections WHERE version_id=\? AND row_status=1`).WillReturnRows(row)
			},
			hasErr: false,
			want: []*models.SectionSchema{
				{1, "Test Section 1"},
			},
		},
	}
	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.mock != nil {
				tCase.mock(mock)
			}
			_, err = GetAllSections(db, tCase.vars.Id)
			if tCase.hasErr {
				assert.Equal(tt, err.Error(), tCase.err)
			} else if err != nil {
				tt.Fatalf("An Unknown Error occured which should not come , error : %v", err)
			}
		})
	}
}

func TestCreateSection(t *testing.T) {
	db, mock, err := sqlmock.New()
	if err != nil {
		t.Fatalf("an error '%s' was not expected when opening a stub database connection", err)
	}
	defer db.Close()

	type vars struct {
		Title string `json:"title"`
		Id    int    `json:"id"`
	}
	testCases := []struct {
		name   string
		vars   vars
		mock   func(sqlmock.Sqlmock)
		hasErr bool
		err    string
		want   []*CreateSectionResponseSchema
	}{
		{
			name: "should fail since invalid version ID",
			vars: vars{
				Id:    1,
				Title: "Test Section",
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\? and row_status != 0`).WithArgs(0).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
			},
			hasErr: true,
			err:    "Version not found",
		},
		{
			name: "should fail since sql error in IsIdExist",
			vars: vars{
				Title: "Test Section",
				Id:    1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\? and row_status != 0`).WithArgs(0).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should fail since title is not valid ",
			vars: vars{
				Title: "Ti",
				Id:    1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\? and row_status != 0`).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
			},
			hasErr: true,
			err:    "Invalid section title.",
		},
		{
			name: "should fail since sql error in model CreateSection function",
			vars: vars{
				Title: "Test Section",
				Id:    1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\? and row_status != 0`).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) as count FROM sections WHERE version_id=\? AND TRIM\(LOWER\(title\)\)=\? AND row_status=1 AND id!=\?`).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
				mock.ExpectExec(`INSERT INTO sections \( section_uuid, version_id, title \) VALUES \( \?, \?, \? \)`).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should pass",
			vars: vars{
				Title: "Test Section",
				Id:    1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM form_versions WHERE id=\? and row_status != 0`).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) as count FROM sections WHERE version_id=\? AND TRIM\(LOWER\(title\)\)=\? AND row_status=1 AND id!=\?`).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
				mock.ExpectExec(`INSERT INTO sections \( section_uuid, version_id, title \) VALUES \( \?, \?, \? \)`).WillReturnResult(sqlmock.NewResult(1, 1))

			},
			hasErr: false,
		},
	}
	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.mock != nil {
				tCase.mock(mock)
			}
			res, err := json.Marshal(tCase.vars)
			if err != nil {
				tt.Fatalf("Error")
			}
			_, err = CreateSection(db, res)
			if tCase.hasErr {
				assert.Equal(tt, err.Error(), tCase.err)
			} else if err != nil {
				tt.Fatalf("An Unknown Error occurred which should not come , error : %v", err)
			}
		})
	}
}

func TestEditSection(t *testing.T) {
	db, mock, err := sqlmock.New()
	if err != nil {
		t.Fatalf("an error '%s' was not expected when opening a stub database connection", err)
	}
	defer db.Close()

	type vars struct {
		Title string `json:"title"`
		Id    int    `json:"id"`
	}
	testCases := []struct {
		name   string
		vars   vars
		mock   func(sqlmock.Sqlmock)
		hasErr bool
		err    string
	}{
		{
			name: "should fail since invalid section ID",
			vars: vars{
				Id:    1,
				Title: "Test Section",
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
			},
			hasErr: true,
			err:    "Section not found",
		},
		{
			name: "should fail since sql error in IsIdExist",
			vars: vars{
				Id:    1,
				Title: "Test Section",
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should fail since section is not active",
			vars: vars{
				Id:    1,
				Title: "Test Section",
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\? and row_status != 0`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
			},
			hasErr: true,
			err:    "Can not update this section",
		},
		{
			name: "should fail since sql error in IsIdExistAndActive",
			vars: vars{
				Id:    1,
				Title: "Test Section",
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\? and row_status != 0`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},

		{
			name: "should fail since sql error in model GetVersionID function",
			vars: vars{
				Id:    2,
				Title: "Test Section",
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(2).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\? and row_status != 0`).WithArgs(2).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT version_id FROM sections WHERE id=\?`).WithArgs(2).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},

		{
			name: "should fail since title is not valid ",
			vars: vars{
				Title: "Ti",
				Id:    1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\? and row_status != 0`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT version_id FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`version_id`}).AddRow(1))
			},
			hasErr: true,
			err:    "Invalid section title.",
		},
		{
			name: "should fail since sql error in models EditSection function",
			vars: vars{
				Title: "Test Section",
				Id:    1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\? and row_status != 0`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT version_id FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`version_id`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) as count FROM sections WHERE version_id=\? AND TRIM\(LOWER\(title\)\)=\? AND row_status=1 AND id!=\?`).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
				mock.ExpectExec(`UPDATE sections SET title=\? WHERE id=\?`).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should pass",
			vars: vars{
				Title: "Test Section",
				Id:    1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\? and row_status != 0`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectQuery(`SELECT version_id FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`version_id`}).AddRow(1))
				mock.ExpectQuery(`SELECT COUNT\(\*\) as count FROM sections WHERE version_id=\? AND TRIM\(LOWER\(title\)\)=\? AND row_status=1 AND id!=\?`).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
				mock.ExpectExec(`UPDATE sections SET title=\? WHERE id=\?`).WithArgs("Test Section", 1).WillReturnResult(sqlmock.NewResult(1, 1))
			},
			hasErr: false,
		},
	}
	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.mock != nil {
				tCase.mock(mock)
			}
			res, err := json.Marshal(tCase.vars)
			if err != nil {
				tt.Fatalf("Error")
			}
			_, err = EditSection(db, res, tCase.vars.Id)

			if tCase.hasErr {
				assert.Equal(tt, err.Error(), tCase.err)
			} else if err != nil {
				tt.Fatalf("An Unknown Error occured which should not come , error : %v", err)
			}
		})
	}
}

func TestDeleteSection(t *testing.T) {
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
		mock   func(sqlmock.Sqlmock)
		hasErr bool
		err    string
	}{
		{
			name: "should fail since invalid section ID",
			vars: vars{
				Id: 1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(0))
			},
			hasErr: true,
			err:    "Section not found",
		},
		{
			name: "should fail since sql error in IsIdExist",
			vars: vars{
				Id: 1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should fail since sql error in models DeleteSection function",
			vars: vars{
				Id: 1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectExec(`UPDATE sections SET row_status=0 WHERE id=?`).WithArgs(1).WillReturnError(fmt.Errorf("SQL Error"))
			},
			hasErr: true,
			err:    "SQL Error",
		},
		{
			name: "should pass",
			vars: vars{
				Id: 1,
			},
			mock: func(mock sqlmock.Sqlmock) {
				mock.ExpectQuery(`SELECT COUNT\(\*\) FROM sections WHERE id=\?`).WithArgs(1).WillReturnRows(sqlmock.NewRows([]string{`count`}).AddRow(1))
				mock.ExpectExec(`UPDATE sections SET row_status=0 WHERE id=?`).WithArgs(1).WillReturnResult(sqlmock.NewResult(1, 1))
			},
			hasErr: false,
		},
	}
	for _, tCase := range testCases {
		t.Run(tCase.name, func(tt *testing.T) {
			if tCase.mock != nil {
				tCase.mock(mock)
			}
			err = DeleteSection(db, tCase.vars.Id)
			if tCase.hasErr {
				assert.Equal(tt, tCase.err, err.Error())
			} else if err != nil {
				tt.Fatalf("An Unknown Error occurred which should not come , error : %v", err)
			}
		})
	}
}
