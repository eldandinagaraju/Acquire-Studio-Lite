import React, { useEffect, useState } from "react";
import { Navigate, Outlet } from "react-router";
import { logoutAction, selectIsLoggedIn } from "../Slice/UserSlice";
import { useDispatch, useSelector } from "react-redux";
import Navbar from "./Navbar/Navbar";
import { Box } from "@mui/material";
import {
  NAVBAR_HEIGHT,
  SESSION_EXPIRY_DIALOG_CONTENT,
  SESSION_EXPIRY_DIALOG_TITLE,
} from "../Constants";
import { useNavigate } from "react-router-dom";
import { getBackgroundColor } from "../utils/themeUtils";
import CustomDialog, { DialogButton } from "./CustomDialog";

function Protected() {
  const [showDialog, setShowDialog] = useState(false);

  useEffect(() => {
    const expireTime = localStorage.getItem("JWT_EXPIRE_TIME");

    const myInterval = setInterval(() => {
      if (new Date().getTime() >= expireTime) {
        setShowDialog(true);
        clearInterval(myInterval);
      }
    }, 1000);
  });
  const navigate = useNavigate();
  const dispatch = useDispatch();

  const isUserLoggedIn = useSelector(selectIsLoggedIn);
  return isUserLoggedIn ? (
    <>
      <Navbar />
      <Box
        sx={{
          display: "flex",
          marginTop: NAVBAR_HEIGHT,
          padding: "0px !important",
          minHeight: `calc(100vh - ${NAVBAR_HEIGHT})`,
          background: getBackgroundColor,
        }}
      >
        <Outlet />
        <CustomDialog
          open={showDialog}
          title={SESSION_EXPIRY_DIALOG_TITLE}
          content={SESSION_EXPIRY_DIALOG_CONTENT}
          dialogButtons={[
            new DialogButton(
              "Back To Login Page",
              { color: "primary.main" },
              () => {
                dispatch(logoutAction());
                navigate("/login");
              }
            ),
          ]}
        />
      </Box>
    </>
  ) : (
    <Navigate to="/login" />
  );
}

export default Protected;
