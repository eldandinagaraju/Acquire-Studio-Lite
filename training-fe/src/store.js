import { configureStore, combineReducers } from "@reduxjs/toolkit";
import snackbarReducer from "./Slice/SnackbarSlice";
import userReducer from "./Slice/UserSlice";
import sectionsReducer from "./Slice/SectionSlice";
import loadingReducer from "./Slice/LoadingSlice";
import themeReducer from "./Slice/ThemeSlice";

const rootReducer = combineReducers({
  snackbar: snackbarReducer,
  user: userReducer,
  formSections: sectionsReducer,
  loadingPages: loadingReducer,
  theme: themeReducer,
});

const store = configureStore({
  reducer: rootReducer,
});

export default store;
