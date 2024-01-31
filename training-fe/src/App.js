import CssBaseline from "@mui/material/CssBaseline";
import { ThemeProvider } from "@mui/material";
import { darkTheme, lightTheme } from "./Constants";
import Snackbar from "./Components/AlertSnackbar";
import RoutesComponent from "./Components/RoutesComponent";
import { useSelector } from "react-redux";
import { selectIsLightTheme } from "./Slice/ThemeSlice";

function App() {
  const isLightTheme = useSelector(selectIsLightTheme);
  return (
    <ThemeProvider theme={isLightTheme ? lightTheme : darkTheme}>
      <CssBaseline />
      <Snackbar />
      <RoutesComponent />
    </ThemeProvider>
  );
}

export default App;
