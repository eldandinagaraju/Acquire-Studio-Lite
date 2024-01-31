import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  snackbarOpen: false,
  snackbarType: "success",
  snackbarMessage: "",
};

export const snackbarSlice = createSlice({
  name: "snackbar",
  initialState,
  reducers: {
    setSnackbar: (state, action) => {
      state.snackbarMessage = action.payload.snackbarMessage;
      state.snackbarOpen = action.payload.snackbarOpen;
      state.snackbarType = action.payload.snackbarType;
    },
    clearSnackbar: (state) => {
      // state.snackbarMessage = initialState.snackbarMessage;
      // state.snackbarType = initialState.snackbarType;
      state.snackbarOpen = initialState.snackbarOpen;
    },
  },
});

export const {
  setSnackbar: setSnackbarAction,
  clearSnackbar: clearSnackbarAction,
} = snackbarSlice.actions;

export const selectSnackbarOpen = (state) => state.snackbar.snackbarOpen;
export const selectSnackbarType = (state) => state.snackbar.snackbarType;
export const selectSnackbarMessage = (state) => state.snackbar.snackbarMessage;

export default snackbarSlice.reducer;

export const createSnackbarObj = (
  snackbarOpen = true,
  snackbarType = "success",
  snackbarMessage = ""
) => ({ snackbarOpen, snackbarType, snackbarMessage });
