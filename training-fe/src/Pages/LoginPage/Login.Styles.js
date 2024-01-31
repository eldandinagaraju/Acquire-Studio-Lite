import { Box, Button, Container, Grid, styled } from "@mui/material";
import logo from "./logo1.png";
import { lightTheme } from "../../Constants";

export const LoginContainer = styled(Container)`
  display: flex;
  height: 100vh;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background-color: ${lightTheme.palette.background.main};
  padding: 1rem;
  max-width: 1500px;

  @media (min-width: 600px) {
    padding-left: 3rem;
    padding-right: 3rem;
  }

  @media (min-width: 900px) {
    padding-left: 8rem;
    padding-right: 8rem;
  }
`;

export const Logo = styled(Grid)`
  background-image: url(${logo});
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  height: 11rem;

  @media (min-width: 400px) {
    height: 15rem;
  }

  @media (min-width: 600px) {
    height: 100%;
  }
`;

export const LoginButton = styled(Button)({
  width: "50%",
  marginTop: "24px",
  marginBottom: "24px",
  backgroundColor: `${lightTheme.palette.primary.darkMain}`,
});

export const LoginForm = styled(Box)({
  margin: "64px 32px",
});
