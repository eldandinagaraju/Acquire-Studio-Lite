import { Box, Button, Toolbar, styled } from "@mui/material";
import MuiAppBar from "@mui/material/AppBar";

export const StyledBox = styled(Box)({
  display: "flex",
  alignItems: "center",
  cursor: "pointer",
  "& p": {
    marginLeft: "5px",
    marginRight: "10px",
  },
});

export const StyledButton = styled(Button)(({ theme }) => ({
  borderColor: `${theme.palette.primary.main} !important`,
  "&:hover": {
    color: `${theme.palette.primary.main} !important`,
  },
}));

export const ToolBarStyle = styled(Toolbar)({
  display: "flex",
  justifyContent: "space-between",
});

export const AppBar = styled(MuiAppBar)({
  background: "black",
});
