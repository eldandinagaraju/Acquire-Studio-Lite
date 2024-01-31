import { Box, Card, MenuItem, styled } from "@mui/material";
import { Grid } from "@mui/material";
import { NAVBAR_HEIGHT, lightTheme } from "../../Constants";
import { TimelineContent } from "@mui/lab";

export const StyledModal = styled(Box)({
  position: "absolute",
  top: "50%",
  left: "50%",
  transform: "translate(-50%, -50%)",
  width: "400px",
  backgroundColor: "white",
  border: "2px solid #0000FF",
  borderRadius: "5px",
  boxShadow: 24,
  padding: "32px",
});

export const ScrollBarStyle = styled(Grid)({
  overflowY: "auto",
  maxHeight: `calc(100vh - ${NAVBAR_HEIGHT})`,
  "&::-webkit-scrollbar": {
    display: "none",
  },
});

export const StyledCard = styled(Card)({
  height: "100%",
  display: "flex",
  flexDirection: "column",
  borderRadius: "10px !important",
  boxShadow: "0px 2px 10px rgba(0, 0, 0, 0.35)",
  transition: "all 0.2s",
  "&:hover": {
    boxShadow: "5px 5px 15px rgba(0, 0, 0, 0.35)",
    transform: "scale(1.05)",
  },
  // backgroundColor: "#B6D1B3",
  backgroundColor: lightTheme.palette.primary.main,
});

export const StyledMenuItem = styled(MenuItem)({
  "&:hover": {
    backgroundColor: "lightgrey !important",
  },
});
export const TimelineContentStyle = styled(TimelineContent)({
  marginTop: "10px",
  marginLeft: "5px",
});
