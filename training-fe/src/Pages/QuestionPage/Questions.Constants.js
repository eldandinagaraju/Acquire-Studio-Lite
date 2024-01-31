export const SINGLE_SELECT_TYPE = "SINGLE_SELECT";
export const MULTI_SELECT_TYPE = "MULTI_SELECT";
export const INTEGER_TYPE = "INT_TYPE";
export const TEXT_TYPE = "TEXT_TYPE";

export const QUESTION_TYPES = [
  SINGLE_SELECT_TYPE,
  MULTI_SELECT_TYPE,
  TEXT_TYPE,
  INTEGER_TYPE,
];

const EQUAL_TO_OPERATOR = { symbol: "=", name: "equal to" };
const LESS_THAN_OPERATOR = { symbol: "<", name: "less than" };
const LESS_THAN_OR_EQUAL_TO_OPERATOR = {
  symbol: "<=",
  name: "less than or equal to",
};
const GREATER_THAN_OPERATOR = { symbol: ">", name: "greater than" };
const GREATER_THAN_OR_EQUAL_TO_OPERATOR = {
  symbol: ">=",
  name: "greater than or equal to",
};
const NOT_EQUAL_TO_OPERATOR = { symbol: "!=", name: "not equal to" };

export const RELATIONAL_OPERATIONS_FOR_INT_TYPE = [
  EQUAL_TO_OPERATOR,
  LESS_THAN_OPERATOR,
  LESS_THAN_OR_EQUAL_TO_OPERATOR,
  GREATER_THAN_OPERATOR,
  GREATER_THAN_OR_EQUAL_TO_OPERATOR,
  NOT_EQUAL_TO_OPERATOR,
];

export const RELATIONAL_OPERATIONS_FOR_OTHER_TYPES = [
  EQUAL_TO_OPERATOR,
  NOT_EQUAL_TO_OPERATOR,
];

export function getRelationalOperationBySymbol(symbol) {
  switch (symbol) {
    case EQUAL_TO_OPERATOR.symbol:
      return EQUAL_TO_OPERATOR.name;
    case LESS_THAN_OPERATOR.symbol:
      return LESS_THAN_OPERATOR.name;
    case GREATER_THAN_OPERATOR.symbol:
      return GREATER_THAN_OPERATOR.name;
    case LESS_THAN_OR_EQUAL_TO_OPERATOR.symbol:
      return LESS_THAN_OR_EQUAL_TO_OPERATOR.name;
    case GREATER_THAN_OR_EQUAL_TO_OPERATOR.symbol:
      return GREATER_THAN_OR_EQUAL_TO_OPERATOR.name;
    case NOT_EQUAL_TO_OPERATOR.symbol:
      return NOT_EQUAL_TO_OPERATOR.name;
    default:
      return "";
  }
}

export const EMPTY_QUESTION_OBJECT = {
  id: null,
  questionText: "",
  questionType: SINGLE_SELECT_TYPE,
  options: [],
  relationalOperation: EQUAL_TO_OPERATOR.symbol,
  correctResponse: [],
  childQuestions: [],
};

export const QUESTION_TEXT_REGEX = /^.+$/;

export const QUESTIONS_PER_PAGE = 5;

export const QUESTION_TEXT_EMPTY_ERROR = "Question text can't be empty!!";
export const QUESTION_TEXT_INVALID_ERROR = "Question text is invalid!!";
export const QUESTION_TYPE_INVALID_ERROR = "Question Type is invalid!!";
export const OPTIONS_LENGTH_ERROR = "There should be atleast two options!!";
export const OPTION_BLANK_ERROR = "Option cannot be blank!!";
export const DUPLICATE_OPTIONS_ERROR = "Options should not be same";
export const INVALID_RELATIONAL_OPERATOR = "Invalid relational operation!!";
export const EMPTY_CORRECT_RESPONSE_ERROR =
  "Please select a correct response!!";
export const INVALID_CORRECT_RESPONSE =
  "Invalid Correct Response, the option is not the parent options!!";
export const INVALID_NUMBER_OF_CORRECT_RESPONSES =
  "Please chose one correct response!!";
export const CORRECT_RESPONSE_CANNOT_BE_EMPTY =
  "Correct response cannot be empty!!";
export const DELETE_DIALOG_TITLE =
  "Are you sure you want to delete this question?";
export const DELETE_DIALOG_CONTENT = `Please consider the potential consequences before proceeding with the deletion of this question, as it may lead to the deletion of all associated child questions.`;

// export const CHILD_QUESTION_ADD_WARNING_TITLE = "Cannot add new Child Question";
export const CHILD_QUESTION_ADD_WARNING_CONTENT = `A question can only have a maximum of 3 child questions.`;

export const CREATE_SECTION_DIALOG_TITLE = "Create Section";
export const CREATE_SECTION_DIALOG_CONTENT =
  "Please enter title of the section you want to create.";
export const SECTION_CREATE_FAIL_ERROR_MESSAGE =
  "Something unexpected happened while creating the section!!";

export const UPDATE_SECTION_DIALOG_TITLE = "Edit Section title";
export const UPDATE_SECTION_DIALOG_CONTENT =
  "Please enter the section title for updation";
export const SECTION_UPDATE_FAIL_ERROR_MESSAGE =
  "Something unexpected happened while updating the section!!";

export const DELETE_SECTION_DIALOG_TITLE = "Delete Section";
export const DELETE_SECTION_DIALOG_CONTENT =
  "Are you sure want to delete this section , all the questions in this section will be deleted.";
export const SECTION_DELETE_SUCCESS_MESSAGE = "Section Successfully deleted";
export const SECTION_DELETE_FAIL_ERROR_MESSAGE =
  "Something unexpected happened while deleting the section , section deletion failed !!";

export const VERSION_PUBLISH_FAIL_ERROR_MESSAGE =
  "Something unexpected happened, version publish failed";
export const VERSION_PUBLISHED_SUCCESS = "Version published successfully";

export const DELETE_VERSION_DIALOG_TITLE = "Delete Version";
export const DELETE_VERSION_DIALOG_CONTENT =
  "This will delete the version permanently";

export const QUESTION_CREATION_SUCCESS = "Question Created Succesfully";
export const QUESTION_CREATION_FAILURE_ERROR_MESSAGE =
  "Something unexpected happened , failed to create question";

export const QUESTION_UPDATE_SUCCESS = "Question Update Succesfully";
export const QUESTION_UPDATE_FAILURE_ERROR_MESSAGE =
  "Something unexpected happened , failed to update question";

export const SECTION_FETCH_ERROR = "failed to fetch the sections";

export const QUESTION_DELETION_SUCCESS = "Question Deleted Successfully";
export const QUESTION_DELETION_FAILED =
  "Something Unexpected happened , failed to delete the question";
export const VERSION_DELETE_SUCCESS_MESSAGE = "Version deleted successfully";
export const VERSION_DELETE_FAILURE_MESSAGE =
  "Something unexpected happened. Deletion failed.";

export const CANNOT_UPDATE_OPTIONS =
  "Cannot update options. Remove the child questions first to update options.";

export const CANNOT_UPDATE_QUESTION_TYPE =
  "Cannot update question type. Remove the child questions first to update question type.";

export const QUESTION_ERRORS_ALERT_MESSAGE =
  "Oops! Please review the fields. Fix errors before confirming!";

export const QUESTION_LOADING_KEY = "questions";
export const SECTION_LOADING_KEY = "sections";

export const EMPTY_SECTIONS_PUBLISH_ERROR_MESSAGE =
  "Cannot publish the version with no sections";

export const QUESTIONS_DUMMY_DATA = [
  {
    id: 1,
    questionText: "what is your name?",
    questionType: TEXT_TYPE,
    options: [],
    relationalOperation: null,
    correctResponse: null,
    childQuestions: [],
  },
  {
    id: 2,
    questionText: "What is your age?",
    questionType: INTEGER_TYPE,
    options: [],
    relationalOperation: null,
    correctResponse: null,
    childQuestions: [
      {
        id: 3,
        questionText: "What kind sports are you into?",
        questionType: MULTI_SELECT_TYPE,
        options: [
          "Football",
          "Cricket",
          "Basketball",
          "Tennis",
          "None of the above",
        ],
        relationalOperation: LESS_THAN_OR_EQUAL_TO_OPERATOR.symbol,
        correctResponse: [20],
        childQuestions: [
          {
            id: 4,
            questionText: "Why don't you play any games?",
            questionType: TEXT_TYPE,
            options: [],
            relationalOperation: EQUAL_TO_OPERATOR.symbol,
            correctResponse: ["None of the above"],
            childQuestions: [],
          },
        ],
      },
      {
        id: 5,
        questionText: "How often do you exercises?",
        questionType: SINGLE_SELECT_TYPE,
        options: ["Daily", "Once or twice a week", "Once a month", "Never"],
        relationalOperation: GREATER_THAN_OPERATOR.symbol,
        correctResponse: [20],
        childQuestions: [
          {
            id: 6,
            questionText: "What kind of exercises do you do?",
            questionType: MULTI_SELECT_TYPE,
            options: [
              "Strenght Training",
              "Cardio",
              "Gymnastics",
              "Recreational Activities",
            ],
            relationalOperation: NOT_EQUAL_TO_OPERATOR.symbol,
            correctResponse: ["Never"],
            childQuestions: [],
          },
          {
            id: 7,
            questionText: "Why don't you exercise?",
            questionType: SINGLE_SELECT_TYPE,
            options: [
              "Lack of time",
              "Lack of effort",
              "Lack of motivation",
              "Lack of interest",
            ],
            relationalOperation: EQUAL_TO_OPERATOR.symbol,
            correctResponse: ["Never"],
            childQuestions: [],
          },
        ],
      },
    ],
  },
  {
    id: 8,
    questionText: "Have you taken any insurance prior to this?",
    questionType: SINGLE_SELECT_TYPE,
    options: ["Yes", "No"],
    relationalOperation: null,
    correctResponse: null,
    childQuestions: [
      {
        id: 9,
        questionText: "What was the name of the previous insurance vendor?",
        questionType: TEXT_TYPE,
        options: [],
        relationalOperation: EQUAL_TO_OPERATOR.symbol,
        correctResponse: ["Yes"],
        childQuestions: [],
      },
      {
        id: 10,
        questionText: "For what period did you have this insurance for?",
        questionType: INTEGER_TYPE,
        options: [],
        relationalOperation: EQUAL_TO_OPERATOR.symbol,
        correctResponse: ["Yes"],
        childQuestions: [],
      },
      {
        id: 11,
        questionText:
          "Can you mention the reason for not opting for an insurance?",
        questionType: TEXT_TYPE,
        options: [],
        relationalOperation: EQUAL_TO_OPERATOR.symbol,
        correctResponse: ["No"],
        childQuestions: [],
      },
    ],
  },
  {
    id: 12,
    questionText: "Do you smoke?",
    questionType: SINGLE_SELECT_TYPE,
    options: ["Yes", "No"],
    relationalOperation: null,
    correctResponse: null,
    childQuestions: [
      {
        id: 13,
        questionText: "For how long(in years) have you been smoking?",
        questionType: INTEGER_TYPE,
        options: [],
        relationalOperation: EQUAL_TO_OPERATOR.symbol,
        correctResponse: ["Yes"],
        childQuestions: [],
      },
      {
        id: 14,
        questionText: "Do you plan to quit smoking?",
        questionType: SINGLE_SELECT_TYPE,
        options: ["Yes", "No"],
        relationalOperation: EQUAL_TO_OPERATOR.symbol,
        correctResponse: ["Yes"],
        childQuestions: [],
      },
    ],
  },
];
