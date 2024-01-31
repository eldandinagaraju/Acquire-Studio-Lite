import { Box } from "@mui/material";
import { styled } from "@mui/styles";

export const ActionBox = styled(Box)({
  display: "flex",
  paddingBottom: "10px",
  justifyContent: "left",
});

export const StyledDivider = styled("hr")(({ theme }) => ({
  height: "1px",
  background: `${theme.palette.mode === "dark" ? "#4a4a4a" : "lightgrey"}`,
  border: "none",
}));
