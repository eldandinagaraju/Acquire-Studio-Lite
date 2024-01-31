import { createTheme } from "@mui/material";

export const defaultTheme = createTheme();
export const lightTheme = createTheme({
  palette: {
    primary: {
      // good in both
      main: "#008a9e",
      // good for light theme
      // main: "#005460",
      // main: "#ffea00",
    },
    secondary: {
      main: "#F9AA74",
    },
    background: {
      light: "#fafafa",
      dark: "#121212",
    },
  },
  typography: {
    fontFamily: "Poppins",
  },
});

export const darkTheme = createTheme({
  palette: {
    mode: "dark",
    primary: {
      // good in both
      main: "#008a9e",
      // good for light theme
      // main: "#005460",
      // main: "#ffea00",
    },
    secondary: {
      main: "#F9AA74",
    },
    background: {
      light: "#fafafa",
      dark: "#121212",
    },
  },
  typography: {
    fontFamily: "Poppins",
  },
});

export const ERROR_SEVERITY = "error";
export const WARNING_SEVERITY = "warning";
export const INFO_SEVERITY = "info";
export const SUCCESS_SEVERITY = "success";

export const NAVBAR_HEIGHT = "60px";
export const DRAWER_WIDTH = "250px";

export const SESSION_EXPIRY_DIALOG_TITLE = "Session Expired";
export const SESSION_EXPIRY_DIALOG_CONTENT =
  "Your Session has Expired , Click the below button to redirect to the login Page , Thank You.";
