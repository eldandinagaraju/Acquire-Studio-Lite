import { Snackbar, makeStyles } from "@material-ui/core";
import { useDispatch, useSelector } from "react-redux";
import {
  createSnackbarObj,
  selectSnackbarMessage,
  selectSnackbarOpen,
  selectSnackbarType,
  setSnackbarAction,
} from "../Slice/SnackbarSlice";
import { Alert } from "@mui/material";

const useStyles = makeStyles((theme) => ({
  root: {
    width: "100%",
    "& > * + *": {
      marginTop: theme.spacing(2),
    },
  },
}));

const CustomizedSnackbars = () => {
  const classes = useStyles();
  const dispatch = useDispatch();
  const snackbarOpen = useSelector(selectSnackbarOpen);
  const snackbarType = useSelector(selectSnackbarType);
  const snackbarMessage = useSelector(selectSnackbarMessage);

  const handleClose = (event, reason) => {
    if (reason === "clickaway") {
      return;
    }
    dispatch(
      setSnackbarAction(createSnackbarObj(false, snackbarType, snackbarMessage))
    );
  };

  return (
    <div className={classes.root}>
      <Snackbar
        open={snackbarOpen}
        autoHideDuration={3000}
        onClose={handleClose}
        anchorOrigin={{ vertical: "top", horizontal: "center" }}
      >
        <Alert
          elevation={6}
          variant="filled"
          onClose={handleClose}
          security={snackbarType}
          severity={snackbarType}
        >
          {snackbarMessage}
        </Alert>
      </Snackbar>
    </div>
  );
};

export default CustomizedSnackbars;
