import {
  clearSnackbarAction,
  createSnackbarObj,
  setSnackbarAction,
} from "../Slice/SnackbarSlice";

export const raiseAlert = (dispatch, message, severity) => {
  dispatch(clearSnackbarAction());
  setTimeout(() => {
    dispatch(setSnackbarAction(createSnackbarObj(true, severity, message)));
  }, 1);
};
