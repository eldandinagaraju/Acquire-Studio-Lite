import React from "react";
import {
  Box,
  Button,
  Checkbox,
  Divider,
  FormControl,
  FormControlLabel,
  FormGroup,
  FormLabel,
  Radio,
  RadioGroup,
  TextField,
  Typography,
} from "@mui/material";
import {
  correctResponseValidation,
  questionTextValidation,
  questionTypeDesc,
  questionTypeValidation,
  relationalOperationValidation,
  validateQuestion,
} from "../../../utils/questionUtils";
import {
  QUESTION_ERRORS_ALERT_MESSAGE,
  INTEGER_TYPE,
  MULTI_SELECT_TYPE,
  QUESTION_TYPES,
  RELATIONAL_OPERATIONS_FOR_INT_TYPE,
  RELATIONAL_OPERATIONS_FOR_OTHER_TYPES,
  SINGLE_SELECT_TYPE,
  TEXT_TYPE,
  getRelationalOperationBySymbol,
} from "../Questions.Constants";
import { CustomMenu } from "../../../Components/Menu";
import DeleteIcon from "@mui/icons-material/Delete";
import AddIcon from "@mui/icons-material/Add";
import EditIcon from "@mui/icons-material/Edit";
import Options from "./Options";
import CloseIcon from "@mui/icons-material/Close";
import CheckIcon from "@mui/icons-material/Check";
import { ActionBox, StyledDivider } from "./QuestionItem.Styles";
import { ERROR_SEVERITY, INFO_SEVERITY, lightTheme } from "../../../Constants";
import { raiseAlert } from "../../../utils/snackbarUtils";
import { useDispatch } from "react-redux";

const borderColorConst = [
  "#00425A",
  "#FC7300",
  "#1F8A70",
  "#BFDB38",
  "#820000",
];

const correctResponseValidationHelper = (
  correctResponse,
  options,
  type,
  updateErrorState
) => {
  const err = [];
  correctResponseValidation(correctResponse, options, type, err);
  updateErrorState({ correctResponse: err });
};

const parentQuestionInputs = (
  { type, options = [] },
  correctResponse = [],
  updateCorrectResponse,
  updateErrorState,
  hasError
) => {
  switch (type) {
    case SINGLE_SELECT_TYPE:
      return (
        <>
          <Typography sx={{ color: "grey" }}>Options</Typography>
          <RadioGroup
            value={correctResponse.length > 0 ? correctResponse[0] : null}
            onChange={(e) => {
              updateCorrectResponse([e.currentTarget.value]);
              if (hasError) {
                correctResponseValidationHelper(
                  [e.currentTarget.value],
                  options,
                  type,
                  updateErrorState
                );
              }
            }}
            onBlur={() =>
              correctResponseValidationHelper(
                correctResponse,
                options,
                type,
                updateErrorState
              )
            }
          >
            {options.map((option, index) => (
              <FormControlLabel
                label={option}
                control={<Radio />}
                key={index}
                value={option}
              />
            ))}
          </RadioGroup>
        </>
      );
    case MULTI_SELECT_TYPE:
      return (
        <FormGroup>
          <>
            <Typography sx={{ color: "grey" }}>Options</Typography>
            {options.map((option, index) => (
              <FormControlLabel
                label={option}
                control={
                  <Checkbox
                    checked={correctResponse.includes(option)}
                    value={option}
                    onChange={(e) => {
                      const selectedOption = e.currentTarget.value;
                      if (correctResponse.includes(selectedOption)) {
                        correctResponse = correctResponse.filter(
                          (item) => item !== selectedOption
                        );
                      } else {
                        correctResponse.unshift(selectedOption);
                      }
                      updateCorrectResponse([...correctResponse]);
                      if (hasError) {
                        correctResponseValidationHelper(
                          correctResponse,
                          options,
                          type,
                          updateErrorState
                        );
                      }
                    }}
                    onBlur={() =>
                      correctResponseValidationHelper(
                        correctResponse,
                        options,
                        type,
                        updateErrorState
                      )
                    }
                  />
                }
                key={index}
              />
            ))}
          </>
        </FormGroup>
      );
    case INTEGER_TYPE:
      return (
        <TextField
          defaultValue={correctResponse.length > 0 ? correctResponse[0] : null}
          type="number"
          variant="standard"
          label="Response"
          error={hasError}
          onChange={(e) => {
            updateCorrectResponse([e.currentTarget.value]);
            if (hasError) {
              correctResponseValidationHelper(
                correctResponse,
                options,
                type,
                updateErrorState
              );
            }
          }}
          onBlur={() =>
            correctResponseValidationHelper(
              correctResponse,
              options,
              type,
              updateErrorState
            )
          }
        />
      );
    case TEXT_TYPE:
      return (
        <TextField
          variant="standard"
          defaultValue={correctResponse.length > 0 ? correctResponse[0] : null}
          label="Response"
          error={hasError}
          onChange={(e) => {
            updateCorrectResponse([e.currentTarget.value]);
            if (hasError) {
              correctResponseValidationHelper(
                correctResponse,
                options,
                type,
                updateErrorState
              );
            }
          }}
          onBlur={() =>
            correctResponseValidationHelper(
              correctResponse,
              options,
              type,
              updateErrorState
            )
          }
        />
      );
    default:
      return <></>;
  }
};

function QuestionItem({
  questionsArray,
  depth,
  questionsInEditMode,
  updateQuestionInEditmode: updateQuestionInEditMode,
  cancelUpdateForQuestion,
  confirmUpdateForQuestion,
  parentData,
  newQuestions,
  addNewQuestionHandler,
  setQuestionIdToDelete,
  errors,
  updateErrorState,
}) {
  const dispatch = useDispatch();

  const getUpdateOptionsFunction = (id) => {
    return (options) => {
      updateQuestionInEditMode(id, { options });
    };
  };

  const getUpdateCorrectResponsesFunction = (id) => {
    return (correctResponse) => {
      updateQuestionInEditMode(id, { correctResponse });
    };
  };

  const getQuestionMenuObj = (id, depth) => {
    const menuObj = [
      {
        title: "Edit",
        icon: <EditIcon fontSize="small" color="primary" />,
        handler: () => {
          const { childQuestions, ...questionToEdit } = questionsArray.find(
            (question) => question.id === id
          );
          updateQuestionInEditMode(id, {
            ...questionToEdit,
            relatedTo: parentData.id,
          });
        },
      },
      {
        title: "Delete",
        icon: <DeleteIcon fontSize="small" color="error" />,
        handler: () => {
          setQuestionIdToDelete(id);
        },
      },
    ];

    if (depth < 1) {
      menuObj.push({
        title: "Add child question",
        handler: () => {
          addNewQuestionHandler(id);
        },
        icon: <AddIcon fontSize="small" color="success" />,
      });
    }

    return menuObj;
  };

  if (questionsArray.length === 0) return <></>;

  return questionsArray.map((question) => {
    const questionEditState = questionsInEditMode[question.id];

    const hasChildQuestions = question.childQuestions.length > 0;

    const errorStateUpdater = (data) =>
      updateErrorState(questionEditState.id, data);

    const questionTypeErrors = questionEditState
      ? errors[questionEditState.id].questionType
      : [];
    const questionTextErrors = questionEditState
      ? errors[questionEditState.id].questionText
      : [];
    const relationalOperationErrors = questionEditState
      ? errors[questionEditState.id].relationalOperation
      : [];
    const correctResponseErrors = questionEditState
      ? errors[questionEditState.id].correctResponse
      : [];

    return (
      <React.Fragment key={question.id}>
        {!questionEditState &&
          question.correctResponse &&
          question.relationalOperation &&
          question.correctResponse.length > 0 && (
            <Typography sx={{ mx: 1 }}>
              {`For the below question to appear the response should be : ${getRelationalOperationBySymbol(
                question.relationalOperation
              )} (${
                question.relationalOperation
              }) ${question.correctResponse.join(", ")}.`}
            </Typography>
          )}
        <Box
          sx={{
            border: `2px solid ${
              borderColorConst[depth % borderColorConst.length]
            }`,
            p: 1,
            m: 1,
            borderRadius: 1,
            position: "relative",
          }}
        >
          {questionEditState ? (
            <>
              <ActionBox>
                <FormControl error={questionTypeErrors.length > 0}>
                  <FormLabel>Question Type</FormLabel>
                  <RadioGroup
                    row
                    name="row-radio-buttons-group"
                    value={questionEditState.questionType ?? SINGLE_SELECT_TYPE}
                    onChange={(e) => {
                      updateQuestionInEditMode(questionEditState.id, {
                        questionType: e.currentTarget.value,
                      });
                      const err = [];
                      questionTypeValidation(
                        e.currentTarget.value,
                        err,
                        hasChildQuestions,
                        question.questionType
                      );
                      errorStateUpdater({ questionType: err });
                    }}
                  >
                    {QUESTION_TYPES.map((type, index) => (
                      <FormControlLabel
                        value={type}
                        control={
                          <Radio
                            sx={{
                              display: "none",
                            }}
                          />
                        }
                        label={questionTypeDesc(type)}
                        key={index}
                        sx={{
                          border: (theme) =>
                            type === questionEditState.questionType ??
                            SINGLE_SELECT_TYPE
                              ? `2px solid ${theme.palette.primary.main}`
                              : `1px solid ${
                                  theme.palette.mode === "dark"
                                    ? "#4a4a4a"
                                    : "lightgrey"
                                }`,
                          px: 2,
                          py: 1,
                          borderRadius: 1,
                          mx: 1,
                          mt: 1,
                        }}
                      />
                    ))}
                  </RadioGroup>
                  {questionTypeErrors.length > 0 && (
                    <ul>
                      {questionTypeErrors.map((val, idx) => (
                        <li className="error" key={idx}>
                          {val}
                        </li>
                      ))}
                    </ul>
                  )}
                </FormControl>
              </ActionBox>
              <TextField
                label={"Question"}
                fullWidth
                sx={{ mb: 2 }}
                variant="standard"
                defaultValue={questionEditState.questionText ?? ""}
                onChange={(e) => {
                  updateQuestionInEditMode(questionEditState.id, {
                    questionText: e.currentTarget.value,
                  });
                  if (questionTextErrors.length > 0) {
                    const err = [];
                    questionTextValidation(questionEditState.questionText, err);
                    errorStateUpdater({ questionText: err });
                  }
                }}
                onBlur={() => {
                  const err = [];
                  questionTextValidation(questionEditState.questionText, err);
                  errorStateUpdater({ questionText: err });
                }}
                error={questionTextErrors.length > 0}
                helperText={questionTextErrors[0]}
              />
              <Box
                sx={{
                  display: { sm: "block", md: "flex" },
                  "& > *": {
                    flexGrow: 1,
                  },
                }}
              >
                <Options
                  options={questionEditState.options}
                  type={questionEditState.questionType}
                  isEdit={true}
                  updateOptionsHandler={getUpdateOptionsFunction(
                    questionEditState.id
                  )}
                  optionError={errors[questionEditState.id].options}
                  updateErrorState={errorStateUpdater}
                  hasChildQuestions={hasChildQuestions}
                  oldOptions={question.options}
                />
                {parentData.type && parentData.options && (
                  <FormControl error={relationalOperationErrors.length > 0}>
                    <FormLabel>
                      Correct response to display this question
                    </FormLabel>
                    <RadioGroup
                      row
                      value={questionEditState.relationalOperation ?? "="}
                      onChange={(e) => {
                        updateQuestionInEditMode(questionEditState.id, {
                          relationalOperation: e.currentTarget.value,
                        });
                        if (relationalOperationErrors.length > 0) {
                          const err = [];
                          relationalOperationValidation(
                            questionEditState.relationalOperation,
                            parentData.type,
                            err
                          );
                          updateErrorState({ relationalOperation: err });
                        }
                      }}
                      onBlur={() => {
                        const err = [];
                        relationalOperationValidation(
                          questionEditState.relationalOperation,
                          parentData.type,
                          err
                        );
                        updateErrorState({ relationalOperation: err });
                      }}
                    >
                      {parentData.type === INTEGER_TYPE
                        ? RELATIONAL_OPERATIONS_FOR_INT_TYPE.map(
                            (relOp, index) => (
                              <FormControlLabel
                                key={index}
                                value={relOp.symbol}
                                label={relOp.symbol}
                                control={<Radio />}
                              />
                            )
                          )
                        : RELATIONAL_OPERATIONS_FOR_OTHER_TYPES.map(
                            (relOp, index) => (
                              <FormControlLabel
                                key={index}
                                value={relOp.symbol}
                                label={relOp.symbol}
                                control={<Radio />}
                              />
                            )
                          )}
                    </RadioGroup>
                    {relationalOperationErrors.length > 0 && (
                      <ul>
                        {relationalOperationErrors.map((val, idx) => (
                          <li className="error" key={idx}>
                            {val}
                          </li>
                        ))}
                      </ul>
                    )}
                    {parentQuestionInputs(
                      parentData,
                      questionEditState.correctResponse,
                      getUpdateCorrectResponsesFunction(questionEditState.id),
                      errorStateUpdater,
                      correctResponseErrors.length > 0
                    )}

                    {correctResponseErrors.length > 0 && (
                      <ul>
                        {correctResponseErrors.map((val, idx) => (
                          <li className="error" key={idx}>
                            {val}
                          </li>
                        ))}
                      </ul>
                    )}
                  </FormControl>
                )}
              </Box>
              <ActionBox display={"flex"} justifyContent={"center"}>
                <Button
                  variant="contained"
                  color="error"
                  sx={{ padding: "5px 10px", marginTop: "2px" }}
                  onClick={() => cancelUpdateForQuestion(question.id)}
                  startIcon={<CloseIcon />}
                >
                  Cancel
                </Button>

                <Button
                  variant="contained"
                  color="success"
                  sx={{ mx: 1, padding: "5px 10px" }}
                  onClick={() => {
                    const [hasError, error] = validateQuestion(
                      questionEditState,
                      parentData.type,
                      parentData.options
                    );
                    errorStateUpdater(error);
                    if (!hasError) confirmUpdateForQuestion(question.id);
                    else {
                      raiseAlert(
                        dispatch,
                        QUESTION_ERRORS_ALERT_MESSAGE,
                        ERROR_SEVERITY
                      );
                    }
                  }}
                  startIcon={<CheckIcon />}
                >
                  Confirm
                </Button>
              </ActionBox>
              {hasChildQuestions && <StyledDivider />}
            </>
          ) : (
            <>
              <CustomMenu
                menuObj={getQuestionMenuObj(question.id, depth)}
                sx={{ position: "absolute", top: "0px", right: "-10px" }}
                iconColor={lightTheme.palette.primary.main}
              />
              <Typography variant="subtitile1" color={"primary.main"}>
                {questionTypeDesc(question.questionType)} question
              </Typography>
              <Typography>Q. {question.questionText}</Typography>
              <Options
                options={question.options}
                type={question.questionType}
                isEdit={false}
              />
            </>
          )}

          <QuestionItem
            questionsArray={[
              ...(question.childQuestions ?? []),
              ...(newQuestions[question.id] ?? []),
            ]}
            depth={depth + 1}
            questionsInEditMode={questionsInEditMode}
            updateQuestionInEditmode={updateQuestionInEditMode}
            cancelUpdateForQuestion={cancelUpdateForQuestion}
            confirmUpdateForQuestion={confirmUpdateForQuestion}
            parentData={{
              id: question.id,
              type: question.questionType,
              options: question.options,
            }}
            newQuestions={newQuestions}
            addNewQuestionHandler={addNewQuestionHandler}
            setQuestionIdToDelete={setQuestionIdToDelete}
            errors={errors}
            updateErrorState={updateErrorState}
          />
        </Box>
      </React.Fragment>
    );
  });
}

export default QuestionItem;
