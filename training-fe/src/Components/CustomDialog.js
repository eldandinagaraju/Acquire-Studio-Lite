import {
  Button,
  Dialog,
  DialogActions,
  DialogContent,
  DialogContentText,
  DialogTitle,
} from "@mui/material";

// const actionButtonsObj = [{ title, sx, handlerFn, autoFocus }];
export function DialogButton(title, sx, handlerFn, autoFocus = false) {
  this.title = title;
  this.sx = sx;
  this.handlerFn = handlerFn;
  this.autoFocus = autoFocus;
}

function CustomDialog({
  open,
  closeFn,
  title,
  content,
  dialogButtons = [],
  inputElement = null,
}) {
  return (
    <Dialog
      open={open}
      onClose={closeFn}
      aria-labelledby="alert-dialog-title"
      aria-describedby="alert-dialog-description"
      disableRestoreFocus
    >
      {title && <DialogTitle id="alert-dialog-title">{title}</DialogTitle>}
      {content && (
        <DialogContent>
          <DialogContentText id="alert-dialog-description">
            {content}
          </DialogContentText>
          {inputElement}
        </DialogContent>
      )}
      {dialogButtons.length > 0 && (
        <DialogActions>
          {dialogButtons.map((dialogButton, index) => (
            <Button
              onClick={dialogButton.handlerFn}
              sx={dialogButton.sx}
              key={index}
            >
              {dialogButton.title}
            </Button>
          ))}
        </DialogActions>
      )}
    </Dialog>
  );
}

export default CustomDialog;
