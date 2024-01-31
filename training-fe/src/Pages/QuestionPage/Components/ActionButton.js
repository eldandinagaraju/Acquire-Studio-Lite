import { Button, Divider, ListItem, ListItemButton } from "@mui/material";

function ActionButton({ title, icon, sx, onClick }) {
  return (
    <>
      <ListItem disablePadding>
        <ListItemButton
          sx={{
            display: "flex",
            justifyContent: "center",
            p: 0,
          }}
          onClick={onClick}
        >
          <Button
            sx={sx}
            disableRipple
            disableFocusRipple
            disableTouchRipple
          >
            {title}
          </Button>
        </ListItemButton>
      </ListItem>
      <Divider />
    </>
  );
}

export default ActionButton;





