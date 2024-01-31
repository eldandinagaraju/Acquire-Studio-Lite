import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  loadingSet: [],
};

export const loadingSlice = createSlice({
  name: "loadingPages",
  initialState,
  reducers: {
    startLoading: (state, action) => {
      if (state.loadingSet.findIndex((item) => item === action.payload) === -1)
        state.loadingSet.push(action.payload);
    },
    stopLoading: (state, action) => {
      state.loadingSet = state.loadingSet.filter(
        (item) => action.payload !== item
      );
    },
  },
});
//TODO: change the ds to set.
export const {
  startLoading: startLoadingAction,
  stopLoading: stopLoadingAction,
} = loadingSlice.actions;

export default loadingSlice.reducer;

export const loadingState = (key) => {
  return (state) =>
    state.loadingPages.loadingSet.findIndex((item) => item === key) !== -1;
};
