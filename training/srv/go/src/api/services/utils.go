package services

import (
	"database/sql"
	"errors"
	"fmt"
	"regexp"
	"strings"

	"github.com/beego/beego/v2/client/orm"
)

// Checks whether that id present in the given table name or not
func IsIdExist(db *sql.DB, tableName string, id int) (int, error) {
	var count int
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return -1, err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("COUNT(*)").From(tableName).Where("id=?")
		sql := qb.String()
		if err = o.Raw(sql, id).QueryRow(&count); err != nil {
			return -1, err
		}
		return count, nil
	}
}

// Checks whether that id is active in the given table name or not
func IsIdExistAndActive(db *sql.DB, tableName string, id int) (int, error) {
	var count int
	o, err := orm.NewOrmWithDB("mysql", "default", db)

	if err != nil {
		return 0, err
	}

	if qb, err := orm.NewQueryBuilder("mysql"); err != nil {
		return -1, err
	} else {
		qb.Select("COUNT(*)").From(tableName).Where("id=? and row_status != 0")
		sql := qb.String()
		if err = o.Raw(sql, id).QueryRow(&count); err != nil {
			return -1, err
		}
		return count, nil
	}
}

func ConvertToTitle(title string) string {
	return strings.Title(strings.ToLower(strings.TrimSpace(title)))
}

func IsTitleValid(title string) error {

	titleRegex := regexp.MustCompile(`^[a-zA-Z][a-zA-Z0-9\-\(\)\_\[\] \:]{1,28}[a-zA-Z0-9\)\]]$`)
	if !titleRegex.MatchString(title) {
		return fmt.Errorf("invalid question text")
	}

	if err := areBracketsBalanced(title); err != nil {
		return err
	}

	return nil
}

func areBracketsBalanced(title string) error {
	// Create a stack to store opening brackets
	stack := []rune{}

	// Define a mapping of opening brackets to their corresponding closing brackets
	bracketPairs := map[rune]rune{
		'(': ')',
		'[': ']',
	}

	// Iterate through each character in the title
	for _, char := range title {
		// If the character is an opening bracket, push it to the stack
		if char == '(' || char == '[' {
			stack = append(stack, char)
		} else if char == ')' || char == ']' {
			// If the character is a closing bracket
			// Check if the stack is empty or if the closing bracket matches the last opening bracket in the stack
			if len(stack) == 0 || bracketPairs[stack[len(stack)-1]] != char {
				return errors.New("Unbalanced brackets")
			}
			// Pop the last opening bracket from the stack
			stack = stack[:len(stack)-1]
		}
	}

	// If the stack is not empty, it means there are unclosed brackets
	if len(stack) > 0 {
		return errors.New("Unbalanced brackets")
	}

	return nil
}
