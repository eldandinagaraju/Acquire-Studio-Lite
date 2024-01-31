import {
  Checkbox,
  FormControl,
  FormControlLabel,
  FormGroup,
  FormLabel,
  IconButton,
  Input,
  Radio,
  Tooltip,
  Typography,
} from "@mui/material";
import { lightTheme } from "../../../Constants";
import { Box } from "@mui/material";
import AddCircleIcon from "@mui/icons-material/AddCircle";
import {
  INTEGER_TYPE,
  MULTI_SELECT_TYPE,
  SINGLE_SELECT_TYPE,
  TEXT_TYPE,
} from "../Questions.Constants";
import DeleteIcon from "@mui/icons-material/Delete";
import { optionsValidation } from "../../../utils/questionUtils";

function getControlForType(type) {
  switch (type) {
    case MULTI_SELECT_TYPE:
      return <Checkbox disabled />;
    case SINGLE_SELECT_TYPE:
      return <Radio disabled />;
    default:
      return;
  }
}

function Options({
  options,
  type,
  isEdit = false,
  updateOptionsHandler,
  optionError = [],
  updateErrorState,
  hasChildQuestions,
  oldOptions,
}) {
  const editOptionHandler = (updatedText, index) => {
    updateOptionsHandler(
      options.map((value, idx) => (idx === index ? updatedText : value))
    );
  };
  const deleteOptionHandler = (index) => {
    options.splice(index, 1);
    updateOptionsHandler([...options]);
  };
  const addOptionHandler = () => {
    updateOptionsHandler([...options, ""]);
  };

  if (type === INTEGER_TYPE || type === TEXT_TYPE) return;

  const hasError = optionError.length > 0;

  return (
    <FormControl error={hasError} sx={{ mb: 2 }}>
      <Box sx={{ flexDirection: "row" }}>
        <FormLabel>Options</FormLabel>
        {isEdit && (
          <Tooltip title={"add new option"} placement="right">
            <IconButton
              sx={{ padding: "0px 10px" }}
              disableRipple
              onClick={addOptionHandler}
            >
              <AddCircleIcon sx={{ color: lightTheme.palette.primary.main }} />
            </IconButton>
          </Tooltip>
        )}
      </Box>
      <FormGroup
        sx={{
          justifyContent: "flex-start !important",
          flexDirection: {
            xs: "column",
            sm: isEdit ? "column" : "row",
          },
        }}
      >
        {options.map((option, index) => {
          return (
            <FormControlLabel
              key={index}
              control={getControlForType(type)}
              label={
                isEdit ? (
                  <FormControl
                    sx={{
                      display: "flex",
                      flexDirection: "row",
                      alignItems: "center",
                    }}
                  >
                    <Input
                      value={option}
                      onChange={(e) => {
                        editOptionHandler(e.currentTarget.value, index);
                        if (hasError) {
                          const err = [];
                          optionsValidation(
                            options,
                            type,
                            err,
                            hasChildQuestions,
                            oldOptions
                          );
                          updateErrorState({ options: err });
                        }
                      }}
                      onBlur={() => {
                        const err = [];
                        optionsValidation(
                          options,
                          type,
                          err,
                          hasChildQuestions,
                          oldOptions
                        );
                        updateErrorState({ options: err });
                      }}
                    />
                    <Tooltip title={"Delete option"} placement="right">
                      <IconButton onClick={() => deleteOptionHandler(index)}>
                        <DeleteIcon sx={{ color: "red" }} />
                      </IconButton>
                    </Tooltip>
                  </FormControl>
                ) : (
                  <Typography>{option}</Typography>
                )
              }
            />
          );
        })}
      </FormGroup>
      {hasError && (
        <ul>
          {optionError.map((val, idx) => (
            <li key={idx} className="error">
              {val}
            </li>
          ))}
        </ul>
      )}
    </FormControl>
  );
}
export default Options;
