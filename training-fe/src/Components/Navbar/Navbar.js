import React from "react";
import {
  FormControlLabel,
  FormGroup,
  IconButton,
  Menu,
  MenuItem,
  Typography,
} from "@mui/material";
import { useDispatch, useSelector } from "react-redux";
import {
  logoutAction,
  selectIsLoggedIn,
  selectName,
} from "../../Slice/UserSlice";
import { useNavigate } from "react-router-dom";
import { NAVBAR_HEIGHT } from "../../Constants";
import { StyledBox, StyledButton, ToolBarStyle } from "./Navbar.styles";
import Logo from "./logo2.png";
import { Person } from "@mui/icons-material";
import {
  openSectionPaneAction,
  selectIsSectionPaneOpen,
  selectShouldShowLeftPane,
} from "../../Slice/SectionSlice";

import MenuIcon from "@mui/icons-material/Menu";
import { AppBar } from "./Navbar.styles";
import { Stack } from "@mui/system";
import Button from "@mui/material/Button";
import { selectIsLightTheme, toggleThemeAction } from "../../Slice/ThemeSlice";
import Brightness4Icon from "@mui/icons-material/Brightness4";
import Brightness7Icon from "@mui/icons-material/Brightness7";

function Navbar() {
  const logoLabel = "Acquire Studio";
  const dispatch = useDispatch();
  const isUserLoggedIn = useSelector(selectIsLoggedIn);
  const shouldShowLeftPane = useSelector(selectShouldShowLeftPane);
  const isLeftPaneOpen = useSelector(selectIsSectionPaneOpen);
  const name = useSelector(selectName);
  const navigate = useNavigate();

  const [anchorEl, setAnchorEl] = React.useState(null);
  const menuOpen = Boolean(anchorEl);
  const handleMenuOpen = (event) => setAnchorEl(event.currentTarget);
  const handleMenuClose = () => setAnchorEl(null);

  const handleOnLogout = () => {
    dispatch(logoutAction());
    navigate("/login");
  };

  const handleDashboardOpen = () => {
    handleMenuClose();
    navigate("/forms");
  };

  const handleDrawerOpen = () => {
    dispatch(openSectionPaneAction());
  };

  const isLightTheme = useSelector(selectIsLightTheme);

  return (
    <AppBar
      position="fixed"
      elevation={0}
      sx={{
        height: NAVBAR_HEIGHT,
        backgroundColor: "primary.main",
      }}
    >
      <ToolBarStyle>
        <Stack sx={{ flexDirection: "row" }}>
          {shouldShowLeftPane && (
            <IconButton
              color="inherit"
              aria-label="open drawer"
              onClick={handleDrawerOpen}
              edge="start"
              sx={{
                mr: 2,
                display: { sm: "none", xs: isLeftPaneOpen ? "none" : "flex" },
                alignSelf: "center",
                justifySelf: "center",
              }}
            >
              <MenuIcon />
            </IconButton>
          )}
          <StyledBox data-testid="logoAndTitle" onClick={handleDashboardOpen} sx={{ cursor: "pointer" }}>
            <img src={Logo} alt="Logo" width={"45px"} height={"40px"} />
            <Typography
              variant="h5"
              color="white"
              paddingLeft={"10px"}
              noWrap
              sx={{ display: { xs: "none", sm: "block" } }}
            >
              {logoLabel} <sup style={{ fontSize: "small" }}>Lite</sup>
            </Typography>
          </StyledBox>
        </Stack>
        {isUserLoggedIn && (
          <StyledBox>
            <IconButton
              sx={{ m: 1 }}
              onClick={() => dispatch(toggleThemeAction())}
            >
              {!isLightTheme ? <Brightness7Icon /> : <Brightness4Icon />}
            </IconButton>

            <IconButton
              sx={{ border: "1px solid white" }}
              aria-label="user"
              id="user"
              aria-controls={menuOpen ? "user-menu" : undefined}
              aria-expanded={menuOpen ? "true" : undefined}
              aria-haspopup="true"
              onClick={handleMenuOpen}
            >
              <Person sx={{ color: "secondary.main" }} />
            </IconButton>
            <Menu
              id="user-menu"
              anchorEl={anchorEl}
              open={menuOpen}
              onClose={handleMenuClose}
              PaperProps={{
                style: {
                  boxShadow: "2px 3px 5px black",
                  display: "flex",
                  flexDirection: "row",
                },
              }}
              MenuListProps={{
                disablePadding: true,
                style: {
                  display: "flex",
                  flexDirection: "column",
                  alignItems: "center",
                },
              }}
            >
              <MenuItem>
                <Typography>{name}</Typography>
              </MenuItem>
              <MenuItem>
                <Button
                  variant="text"
                  sx={{
                    textTransform: "none",
                    padding: 0,
                  }}
                  onClick={handleDashboardOpen}
                >
                  Dashboard
                </Button>
              </MenuItem>
              <MenuItem sx={{ justifyContent: "center" }}>
                <StyledButton variant="outlined" onClick={handleOnLogout}>
                  Logout
                </StyledButton>
              </MenuItem>
            </Menu>
          </StyledBox>
        )}
      </ToolBarStyle>
    </AppBar>
  );
}

export default Navbar;
