import { Button, Typography } from "@mui/material";
import "./NotFound.css";
import { useNavigate } from "react-router-dom";
import { useEffect } from "react";
import { useDispatch } from "react-redux";
import { setSelectedSectionIdAction } from "../../Slice/SectionSlice";
function NotFoundPage() {
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(setSelectedSectionIdAction({ id: null }));
  }, [dispatch]);

  const navigate = useNavigate();
  return (
    <div id="notfound">
      <div className="notfound">
        <div className="notfound-404">
          <Typography variant="h3">Oops! Page not found</Typography>
          <h1>
            <span>4</span>
            <span>0</span>
            <span>4</span>
          </h1>
        </div>
        <Typography variant="h2">
          we are sorry, but the page you were looking for was not found
        </Typography>
        <Button
          variant="contained"
          onClick={() => {
            navigate("/forms");
          }}
        >
          Go back to home
        </Button>
      </div>
    </div>
  );
}

export default NotFoundPage;
