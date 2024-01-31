const { 
    SINGLE_SELECT_TYPE, 
    MULTI_SELECT_TYPE, 
    TEXT_TYPE, 
    INTEGER_TYPE,
    QUESTION_TEXT_EMPTY_ERROR, 
    QUESTION_TEXT_INVALID_ERROR,
    QUESTION_TYPE_INVALID_ERROR, 
    OPTIONS_LENGTH_ERROR, 
    INVALID_RELATIONAL_OPERATOR,
    CORRECT_RESPONSE_CANNOT_BE_EMPTY, 
    EMPTY_CORRECT_RESPONSE_ERROR, 
    OPTION_BLANK_ERROR, 
    DUPLICATE_OPTIONS_ERROR, 
    INVALID_CORRECT_RESPONSE,
    CANNOT_UPDATE_QUESTION_TYPE,
    INVALID_NUMBER_OF_CORRECT_RESPONSES,
    CANNOT_UPDATE_OPTIONS
} = require("../Pages/QuestionPage/Questions.Constants");
const utils = require("./questionUtils")

describe("questionUtils component", () => {
    test("testing the question types", () => {
        expect(utils.questionTypeDesc(SINGLE_SELECT_TYPE)).toBe("Single select type");
        expect(utils.questionTypeDesc(MULTI_SELECT_TYPE)).toBe("Multiple select type");
        expect(utils.questionTypeDesc(TEXT_TYPE)).toBe("Text based");
        expect(utils.questionTypeDesc(INTEGER_TYPE)).toBe("Number based");
        expect(utils.questionTypeDesc("Single")).toBe("Unknown type");
    });

    test("testing the question text", () => {
        const errors = [];
        utils.questionTextValidation("", errors);
        utils.questionTextValidation("   ", errors);
        utils.questionTextValidation("What is your name?", errors);
        expect(errors).toStrictEqual([QUESTION_TEXT_INVALID_ERROR, QUESTION_TEXT_EMPTY_ERROR]);
    });

    test("testing the options of questions", () => {
        const errors = [];
        utils.optionsValidation([], TEXT_TYPE, errors);
        utils.optionsValidation([], SINGLE_SELECT_TYPE, errors);
        utils.optionsValidation(["once", ""], SINGLE_SELECT_TYPE, errors);
        utils.optionsValidation(["once", "once"], SINGLE_SELECT_TYPE, errors);
        utils.optionsValidation(["once", "thrice"], SINGLE_SELECT_TYPE, errors, true, ["once", "twice"]);
        expect(errors).toStrictEqual([OPTIONS_LENGTH_ERROR, OPTION_BLANK_ERROR, DUPLICATE_OPTIONS_ERROR, CANNOT_UPDATE_OPTIONS]);
    });

    test("testing the question type validations", () => {
        const errors = [];
        utils.questionTypeValidation("SINGLE_SELECT_TYPE", errors);
        utils.questionTypeValidation(SINGLE_SELECT_TYPE, errors, true, MULTI_SELECT_TYPE);
        expect(errors).toStrictEqual([QUESTION_TYPE_INVALID_ERROR, CANNOT_UPDATE_QUESTION_TYPE]);
    });

    test("testing the relational operation validations", () => {
        const errors = [];
        utils.relationalOperationValidation("<>", INTEGER_TYPE, errors);
        utils.relationalOperationValidation("<=", INTEGER_TYPE, errors);
        utils.relationalOperationValidation("<", TEXT_TYPE, errors);
        utils.relationalOperationValidation("=", SINGLE_SELECT_TYPE, errors);
        utils.relationalOperationValidation("=", "SINGLE", errors);
        expect(errors).toStrictEqual([INVALID_RELATIONAL_OPERATOR, INVALID_RELATIONAL_OPERATOR]);
    });

    test("testing the correct response validations", () => {
        let errors = [];
        utils.correctResponseValidation([], ["1", "2"], MULTI_SELECT_TYPE, errors);
        utils.correctResponseValidation(["3"], ["1", "2"], MULTI_SELECT_TYPE, errors);
        utils.correctResponseValidation(["1"], ["1", "2"], MULTI_SELECT_TYPE, errors);
        expect(errors).toStrictEqual([EMPTY_CORRECT_RESPONSE_ERROR, INVALID_CORRECT_RESPONSE]);
        errors = [];
        utils.correctResponseValidation([], ["1", "2"], SINGLE_SELECT_TYPE, errors);
        utils.correctResponseValidation(["3"], ["1", "2"], SINGLE_SELECT_TYPE, errors);
        utils.correctResponseValidation(["1", "2"], ["1", "2"], SINGLE_SELECT_TYPE, errors);
        utils.correctResponseValidation(["1"], ["1", "2"], SINGLE_SELECT_TYPE, errors);
        expect(errors).toStrictEqual([EMPTY_CORRECT_RESPONSE_ERROR, INVALID_CORRECT_RESPONSE, INVALID_NUMBER_OF_CORRECT_RESPONSES]);
        errors = [];
        utils.correctResponseValidation(["1", "2"], [], INTEGER_TYPE, errors);
        utils.correctResponseValidation([], [], INTEGER_TYPE, errors);
        utils.correctResponseValidation(["1"], [], INTEGER_TYPE, errors);
        expect(errors).toStrictEqual([INVALID_NUMBER_OF_CORRECT_RESPONSES, CORRECT_RESPONSE_CANNOT_BE_EMPTY]);
        errors = [];
        utils.correctResponseValidation(["1", "2"], [], TEXT_TYPE, errors);
        utils.correctResponseValidation([], [], TEXT_TYPE, errors);
        utils.correctResponseValidation(["1"], [], INTEGER_TYPE, errors);
        utils.correctResponseValidation(["1"], [], "SINGLE", errors);
        utils.correctResponseValidation(null, null, TEXT_TYPE, errors);
        expect(errors).toStrictEqual([INVALID_NUMBER_OF_CORRECT_RESPONSES, CORRECT_RESPONSE_CANNOT_BE_EMPTY]);
    });

    test("testing the validate question function", () => {
        const question = {
                    correctResponse : ["twice"],
                    options: ["Yes", "No"],
                    questionText: "Do you like pizza ?",
                    questionType: SINGLE_SELECT_TYPE,
                    relatedTo: 1,
                    relationalOperation: "="
                };
        const returnValue = [ false, {
            "correctResponse": [],
            "options": [],
            "questionText": [],
            "questionType": [],
            "relationalOperation": [],
        }]
        expect(utils.validateQuestion(question, SINGLE_SELECT_TYPE, ["once", "twice"], false, ["Yes", "No"], SINGLE_SELECT_TYPE)).toStrictEqual(returnValue);
    });

    test("testing the sentence case function", () => {
        expect(utils.sentenceCase("")).toBe(false);
        expect(utils.sentenceCase("personaL information")).toBe("Personal Information");
    });

    test("testing the title validations function", () => {
        expect(utils.titleValidation("123")).toBe(true);
        expect(utils.titleValidation("Basic Info [[2]")).toBe(true);
        expect(utils.titleValidation("Basic Info [2]]")).toBe(true);
        expect(utils.titleValidation("Basic Info")).toBe(false);
    });
});