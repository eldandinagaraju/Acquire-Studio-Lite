import { SortRounded } from "@mui/icons-material";
import {
  DUPLICATE_OPTIONS_ERROR,
  INTEGER_TYPE,
  MULTI_SELECT_TYPE,
  OPTION_BLANK_ERROR,
  QUESTION_TEXT_EMPTY_ERROR,
  QUESTION_TEXT_INVALID_ERROR,
  QUESTION_TEXT_REGEX,
  QUESTION_TYPES,
  QUESTION_TYPE_INVALID_ERROR,
  SINGLE_SELECT_TYPE,
  TEXT_TYPE,
  RELATIONAL_OPERATIONS_FOR_INT_TYPE,
  INVALID_RELATIONAL_OPERATOR,
  RELATIONAL_OPERATIONS_FOR_OTHER_TYPES,
  EMPTY_CORRECT_RESPONSE_ERROR,
  INVALID_CORRECT_RESPONSE,
  INVALID_NUMBER_OF_CORRECT_RESPONSES,
  CORRECT_RESPONSE_CANNOT_BE_EMPTY,
  OPTIONS_LENGTH_ERROR,
  CANNOT_UPDATE_QUESTION_TYPE,
  CANNOT_UPDATE_OPTIONS,
} from "../Pages/QuestionPage/Questions.Constants";

export const questionTypeDesc = (questionTypeKey) => {
  switch (questionTypeKey) {
    case SINGLE_SELECT_TYPE:
      return "Single select type";
    case MULTI_SELECT_TYPE:
      return "Multiple select type";
    case TEXT_TYPE:
      return "Text based";
    case INTEGER_TYPE:
      return "Number based";
    default:
      return "Unknown type";
  }
};

// this function will check all fields related to a question.
// this will also return a boolean which will check if there is an error or not.
export const validateQuestion = (
  question,
  parentQuestionType,
  parentOptions,
  hasChildQuestions,
  oldOptions,
  oldQuestionType
) => {
  const questionText = [];
  questionTextValidation(question.questionText, questionText);

  const options = [];
  optionsValidation(
    question.options,
    question.questionType,
    options,
    hasChildQuestions,
    oldOptions
  );

  const questionType = [];
  questionTypeValidation(
    question.questionType,
    questionType,
    hasChildQuestions,
    oldQuestionType
  );

  const relationalOperation = [];
  relationalOperationValidation(
    question.relationalOperation,
    parentQuestionType,
    relationalOperation
  );

  const correctResponse = [];
  correctResponseValidation(
    question.correctResponse,
    parentOptions,
    parentQuestionType,
    correctResponse
  );
  return [
    questionText.length > 0 ||
      options.length > 0 ||
      questionType.length > 0 ||
      relationalOperation.length > 0 ||
      correctResponse.length > 0,
    {
      questionText,
      options,
      questionType,
      relationalOperation,
      correctResponse,
    },
  ];
};

export const questionTextValidation = (questionText, errors) => {
  // question text should not be empty
  if (questionText && questionText.trim().length === 0) {
    errors.push(QUESTION_TEXT_EMPTY_ERROR);
    return;
  }
  if (!QUESTION_TEXT_REGEX.test(questionText)) {
    errors.push(QUESTION_TEXT_INVALID_ERROR);
    return;
  }
};

export const questionTypeValidation = (
  questionType,
  errors,
  hasChildQuestions,
  oldQuestionType
) => {
  // the question should be one of the standard question types.
  if (!QUESTION_TYPES.includes(questionType)) {
    errors.push(QUESTION_TYPE_INVALID_ERROR);
  }

  // this is to make sure that the question type is not modified
  // when there are child questions.
  if (hasChildQuestions && oldQuestionType !== questionType) {
    errors.push(CANNOT_UPDATE_QUESTION_TYPE);
  }
};

// this function would replace the spaces(more than 2) with a single space
// and then perform trim on it.
function removeExtraSpaces(word) {
  return word.replace(/\s+/g, " ").trim().toLowerCase();
}

// this function is to validate the options.
export const optionsValidation = (
  options,
  questionType,
  errors,
  hasChildQuestions,
  oldOptions
) => {
  // there is no need to check if the question is of type int and text.
  if (questionType === TEXT_TYPE || questionType === INTEGER_TYPE) return;
  // there should be at least 2 options
  if (options.length < 2) {
    errors.push(OPTIONS_LENGTH_ERROR);
  }

  // any of the option should not be blank.
  if (options.length > 0)
    for (const option of options) {
      if (option.trim().length === 0) {
        errors.push(OPTION_BLANK_ERROR);
        break;
      }
    }

  // there should not be any duplicate options.
  const optionSet = new Set();
  for (const option of options) {
    if (optionSet.has(removeExtraSpaces(option))) {
      errors.push(DUPLICATE_OPTIONS_ERROR);
      break;
    }
    const optionToAdd = removeExtraSpaces(option);
    if (optionToAdd.length !== 0) optionSet.add(optionToAdd);
  }

  // this is to make sure that the options are not modified
  // when there are child questions.
  if (
    hasChildQuestions &&
    Array.isArray(options) &&
    Array.isArray(oldOptions) &&
    !options.every((val, idx) => val === oldOptions[idx])
  ) {
    errors.push(CANNOT_UPDATE_OPTIONS);
  }
};

export const relationalOperationValidation = (
  relationalOperation,
  parentQuestionType,
  errors
) => {
  switch (parentQuestionType) {
    case INTEGER_TYPE:
      if (
        !RELATIONAL_OPERATIONS_FOR_INT_TYPE.map((op) => op.symbol).includes(
          relationalOperation
        )
      ) {
        errors.push(INVALID_RELATIONAL_OPERATOR);
        return;
      }
      break;
    case TEXT_TYPE:
    case MULTI_SELECT_TYPE:
    case SINGLE_SELECT_TYPE:
      if (
        !RELATIONAL_OPERATIONS_FOR_OTHER_TYPES.map((op) => op.symbol).includes(
          relationalOperation
        )
      ) {
        errors.push(INVALID_RELATIONAL_OPERATOR);
        return;
      }
      break;
    default:
      return;
  }
};
export const correctResponseValidation = (
  correctResponse,
  parentOptions,
  parentQuestionType,
  errors
) => {
  if (parentQuestionType === null || parentOptions === null) return;
  switch (parentQuestionType) {
    case MULTI_SELECT_TYPE:
      if (correctResponse.length === 0) {
        errors.push(EMPTY_CORRECT_RESPONSE_ERROR);
        return;
      }
      if (!correctResponse.every((option) => parentOptions.includes(option))) {
        errors.push(INVALID_CORRECT_RESPONSE);
        return;
      }
      break;
    case SINGLE_SELECT_TYPE:
      if (correctResponse.length === 0) {
        errors.push(EMPTY_CORRECT_RESPONSE_ERROR);
        return;
      }
      if (correctResponse.length > 1) {
        errors.push(INVALID_NUMBER_OF_CORRECT_RESPONSES);
        return;
      }
      if (!parentOptions.includes(correctResponse[0])) {
        errors.push(INVALID_CORRECT_RESPONSE);
        return;
      }
      break;
    case TEXT_TYPE:
    case INTEGER_TYPE:
      if (correctResponse.length > 1) {
        errors.push(INVALID_NUMBER_OF_CORRECT_RESPONSES);
        return;
      }
      if (
        !correctResponse[0] ||
        correctResponse[0].toString().trim().length === 0
      ) {
        errors.push(CORRECT_RESPONSE_CANNOT_BE_EMPTY);
        return;
      }
      break;
    default:
      return;
  }
};

export const sentenceCase = (str) => {
  if (str === null || str === "") return false;
  else str = str.toString();

  return str.replace(/\w\S*/g, function (txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
};

export const titleValidation = (title) => {
  // eslint-disable-next-line
  const titleRegex =
    /^[a-zA-Z][a-zA-Z0-9\-\(\)\_\[\] \:]{1,28}[a-zA-Z0-9\)\]]$/;
  if (!titleRegex.test(title)) {
    return true;
  }

  if (!areBracketsBalanced(title)) {
    return true;
  }

  return false;
};

function areBracketsBalanced(title) {
  // Create a stack to store opening brackets
  let stack = [];

  // Define a mapping of opening brackets to their corresponding closing brackets
  let bracketPairs = {
    "(": ")",
    "[": "]",
  };

  // Iterate through each character in the title
  for (let char of title) {
    // If the character is an opening bracket, push it to the stack
    if (char === "(" || char === "[") {
      stack.push(char);
    } else if (char === ")" || char === "]") {
      // If the character is a closing bracket
      // Check if the stack is empty or if the closing bracket
      //matches the last opening bracket in the stack
      if (
        stack.length === 0 ||
        bracketPairs[stack[stack.length - 1]] !== char
      ) {
        return false;
      }
      // Pop the last opening bracket from the stack
      stack.pop();
    }
  }

  // If the stack is not empty, it means there are unclosed brackets
  if (stack.length > 0) {
    return false;
  }
  return true;
}
