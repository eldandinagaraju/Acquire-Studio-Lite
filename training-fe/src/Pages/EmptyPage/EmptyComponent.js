import React from "react";
import { CircularProgress, Typography } from "@mui/material";
import EmptyIcon from "./empty.png";

function EmptyComponent({ message, isLoading }) {
  return (
    <div
      style={{
        display: "flex",
        flexDirection: "column",
        alignItems: "center",
        justifyContent: "center",
        width: "100%",
        height: message === "sections" ? "92%" : "",
      }}
    >
      {isLoading ? (
        <CircularProgress />
      ) : (
        <>
          <img src={EmptyIcon} alt="Loading" width="100px" />
          <Typography sx={{ color: "gray" }} textAlign={"center"}>
            No {message} to display
          </Typography>
          {/* <Button sx={{ mt: 1 }}>Add {message.slice(0, -1)}</Button> */}
        </>
      )}
    </div>
  );
}

export default EmptyComponent;
