import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  name: localStorage.getItem("name") ?? "",
  token: localStorage.getItem("token") ?? "",
};

const TOKEN_EXPIRY_HOURS = process.env.REACT_APP_TOKEN_EXPIRY_HOURS;

export const userSlice = createSlice({
  name: "user",
  initialState,
  reducers: {
    login: (state, action) => {
      state.name = action.payload.name;
      state.token = action.payload.token;
      localStorage.setItem("name", action.payload.name);
      localStorage.setItem("token", action.payload.token);
      localStorage.setItem(
        "JWT_EXPIRE_TIME",
        new Date().getTime() + TOKEN_EXPIRY_HOURS * 60 * 60 * 1000
      );
      return state;
    },
    logout: (state) => {
      state.name = "";
      state.token = "";
      state.expireTime = "";
      localStorage.clear();
      sessionStorage.clear();
    },
  },
});

export const { login: loginAction, logout: logoutAction } = userSlice.actions;
export const selectIsLoggedIn = (state) => !(state.user.token.length === 0);
export const selectName = (state) => state.user.name;
export const selectAuth = (state) => ({
  token: state.user.token,
});
export default userSlice.reducer;
