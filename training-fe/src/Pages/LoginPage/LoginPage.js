import React, { useEffect } from "react";
import {
  Box,
  FormControl,
  Grid,
  IconButton,
  InputAdornment,
  InputLabel,
  OutlinedInput,
  Paper,
  TextField,
  Typography,
  Alert,
} from "@mui/material";
import { Visibility, VisibilityOff } from "@mui/icons-material";
import {
  ErrorText,
  LOGIN_SUCCESS_MESSAGE,
  LoginLabel,
} from "./Login.Constants";
import { LoginButton, LoginContainer, LoginForm, Logo } from "./Login.Styles";
import { useNavigate } from "react-router-dom";
import { api } from "../../utils/apiMethods";
import { useDispatch, useSelector } from "react-redux";
import { raiseAlert } from "../../utils/snackbarUtils";
import { SUCCESS_SEVERITY, lightTheme } from "../../Constants";
import { loginAction } from "../../Slice/UserSlice";
import { setSelectedSectionIdAction } from "../../Slice/SectionSlice";
import { selectIsLightTheme, toggleThemeAction } from "../../Slice/ThemeSlice";
import Brightness4Icon from "@mui/icons-material/Brightness4";
import Brightness7Icon from "@mui/icons-material/Brightness7";

const LoginPage = () => {
  const navigate = useNavigate();
  const [showPassword, setShowPassword] = React.useState(false);
  const [validUsername, setValidUsername] = React.useState(true);
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(setSelectedSectionIdAction({ id: null }));
  }, [dispatch]);

  const [validCredentials, setValidCredentials] = React.useState(true);
  const [userDetails, setUserDetails] = React.useState({
    email: "",
    password: "",
  });
  const usernameRegex = /^[\w-.]+@[\w]{3,}\.[\w]{2,4}$/;

  const handleChange = (event) => {
    if (event.target.name === "email") {
      setValidUsername(usernameRegex.test(event.target.value));
    }
    setUserDetails({ ...userDetails, [event.target.name]: event.target.value });
  };

  const handleClickShowPassword = () => setShowPassword((show) => !show);

  const handleMouseDownPassword = (event) => {
    event.preventDefault();
    setShowPassword((show) => !show);
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    try {
      const resp = await api.post("/login", userDetails);
      raiseAlert(dispatch, LOGIN_SUCCESS_MESSAGE, SUCCESS_SEVERITY);
      dispatch(
        loginAction({ token: resp.data.data.jwtToken, name: userDetails.email })
      );
      setValidUsername(false);
      setUserDetails({
        email: "",
        password: "",
      });
      navigate("/forms");
    } catch (err) {
      console.log(err);
      setValidCredentials(false);
    }
  };

  const isLightTheme = useSelector(selectIsLightTheme);

  return (
    <LoginContainer maxWidth>
      <Grid container>
        <Logo item xs={12} sm={6} md={7} />
        <Grid
          item
          xs={12}
          sm={6}
          md={5}
          component={Paper}
          elevation={6}
          sx={{ position: "relative" }}
        >
          <LoginForm>
            <Typography
              component="h1"
              variant="h4"
              textAlign={"center"}
              sx={{ color: lightTheme.palette.primary.main }}
            >
              {LoginLabel}
            </Typography>
            {!validCredentials && (
              <Alert severity="error">Invalid Username or Password</Alert>
            )}
            <Box
              component="form"
              sx={{
                mt: 1,
                display: "flex",
                flexDirection: "column",
                alignItems: "center",
              }}
              onSubmit={handleSubmit}
            >
              <TextField
                error={!validUsername}
                margin="normal"
                required
                fullWidth
                id="username"
                label="Username"
                name="email"
                value={userDetails["email"]}
                onChange={handleChange}
                helperText={
                  !validUsername && <Typography>{ErrorText}</Typography>
                }
              />
              <FormControl
                margin="normal"
                required
                fullWidth
                variant="outlined"
              >
                <InputLabel htmlFor="password">Password</InputLabel>
                <OutlinedInput
                  id="password"
                  name="password"
                  value={userDetails["password"]}
                  type={showPassword ? "text" : "password"}
                  endAdornment={
                    <InputAdornment position="end">
                      <IconButton
                        aria-label="toggle password visibility"
                        onClick={handleClickShowPassword}
                        onMouseDown={handleMouseDownPassword}
                        edge="end"
                      >
                        {showPassword ? <Visibility /> : <VisibilityOff />}
                      </IconButton>
                    </InputAdornment>
                  }
                  label="Password"
                  onChange={handleChange}
                />
              </FormControl>
              <LoginButton type="submit" variant="contained">
                {LoginLabel}
              </LoginButton>
            </Box>
          </LoginForm>
        </Grid>
      </Grid>
      <IconButton
        sx={{
          m: 1,
          position: "absolute",
          bottom: "10px",
          right: "10px",
          boxShadow: "5px 5px 5px rgba(0,0,0,0.5)",
        }}
        onClick={() => dispatch(toggleThemeAction())}
      >
        {!isLightTheme ? <Brightness7Icon /> : <Brightness4Icon />}
      </IconButton>
    </LoginContainer>
  );
};

export default LoginPage;
