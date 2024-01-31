import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  isLightTheme: JSON.parse(localStorage.getItem("isLightTheme")) ?? true,
};

export const themeSlice = createSlice({
  name: "theme",
  initialState,
  reducers: {
    toggleTheme: (state) => {
      state.isLightTheme = !state.isLightTheme;
      localStorage.setItem("isLightTheme", state.isLightTheme);
    },
  },
});

export const { toggleTheme: toggleThemeAction } = themeSlice.actions;

export const selectIsLightTheme = (state) => state.theme.isLightTheme;

export default themeSlice.reducer;
