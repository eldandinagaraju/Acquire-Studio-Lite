export const getBackgroundColor = (theme) =>
  theme.palette.mode === "light"
    ? theme.palette.background.light
    : theme.palette.background.dark;
