import * as React from "react";
import IconButton from "@mui/material/IconButton";
import Menu from "@mui/material/Menu";
import MenuItem from "@mui/material/MenuItem";
import MoreVertIcon from "@mui/icons-material/MoreVert";
import MoreHorizIcon from "@mui/icons-material/MoreHoriz";
import { Box, ListItemIcon } from "@mui/material";

export function CustomMenu({ menuObj, horizontal = false, sx, iconColor, id }) {
  const [anchorEl, setAnchorEl] = React.useState(null);
  const open = Boolean(anchorEl);
  const handleClick = (event) => {
    setAnchorEl(event.currentTarget);
  };
  const handleClose = () => {
    setAnchorEl(null);
  };
  return (
    <Box sx={sx}>
      <IconButton
        aria-label={"more"+id}
        id="long-button"
        aria-controls={open ? "long-menu" : undefined}
        aria-expanded={open ? "true" : undefined}
        aria-haspopup="true"
        onClick={handleClick}
      >
        {horizontal ? (
          <MoreHorizIcon sx={{ color: iconColor }} />
        ) : (
          <MoreVertIcon sx={{ color: iconColor }} />
        )}
      </IconButton>
      <Menu
        data-testid="basic-menu"
        anchorEl={anchorEl}
        open={open}
        onClose={handleClose}
        MenuListProps={{
          "aria-labelledby": "basic-button",
        }}
      >
        {menuObj.map((item, index) => (
          <MenuItem
            key={index}
            data-testid={item.title}
            onClick={() => {
              item.handler();
              handleClose();
            }}
          >
            {item.icon && <ListItemIcon>{item.icon}</ListItemIcon>}
            {item.title}
          </MenuItem>
        ))}
      </Menu>
    </Box>
  );
}
