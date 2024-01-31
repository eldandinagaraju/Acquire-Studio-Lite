import React, { useEffect, useRef } from "react";
import Button from "@mui/material/Button";
import Timeline from "@mui/lab/Timeline";
import TimelineItem from "@mui/lab/TimelineItem";
import TimelineSeparator from "@mui/lab/TimelineSeparator";
import TimelineConnector from "@mui/lab/TimelineConnector";
import TimelineContent from "@mui/lab/TimelineContent";
import TimelineDot from "@mui/lab/TimelineDot";
import CardContent from "@mui/material/CardContent";
import Grid from "@mui/material/Grid";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import Container from "@mui/material/Container";
import InputAdornment from "@mui/material/InputAdornment";
import { Fab, IconButton, TextField } from "@mui/material";
import CustomDialog, { DialogButton } from "../../Components/CustomDialog";
import { useState } from "react";
import { StyledCard } from "./Formslist.Styles";
import { CustomMenu } from "../../Components/Menu";
import EditIcon from "@mui/icons-material/Edit";
import DeleteIcon from "@mui/icons-material/Delete";
import AddIcon from "@mui/icons-material/Add";
import EmptyComponent from "../EmptyPage/EmptyComponent";

import { useNavigate } from "react-router-dom";
import {
  NEW_FORM_LABEL,
  VERSION_LABEL,
  FORM_CREATE_SUCCESS_MESSAGE,
  FORM_CREATE_FAILURE_MESSAGE,
  NO_FORM_VERSIONS_MESSAGE,
  FORM_FETCH_FAIL_ERROR_MESSAGE,
  FORM_DELETE_SUCCESS_MESSAGE,
  FORM_DELETE_FAILURE_MESSAGE,
  DELETE_DIALOG_TITLE,
  DELETE_DIALOG_CONTENT,
  TITLE_EMPTY_ERROR_MESSAGE,
  UPDATE_FORM_DIALOG_CONTENT,
  UPDATE_FORM_DIALOG_TITLE,
  CREATE_FORM_DIALOG_TITLE,
  CREATE_FORM_DIALOG_CONTENT,
  VERSION_CREATE_SUCCESS_MESSAGE,
  VERSION_CREATION_FAILED_MESSAGE,
  FORM_LOADING_CONSTANT,
  VERSION_PANE_WIDTH,
  TITLE_ERROR_MESSAGE,
} from "./Formslist.Constants";
import { useDispatch, useSelector } from "react-redux";
import {
  ERROR_SEVERITY,
  SUCCESS_SEVERITY,
  INFO_SEVERITY,
  lightTheme,
  NAVBAR_HEIGHT,
} from "../../Constants";

import { raiseAlert } from "../../utils/snackbarUtils";
import { api } from "../../utils/apiMethods";
import CloseIcon from "@mui/icons-material/Close";
import { Add, Search } from "@mui/icons-material";
import { selectAuth } from "../../Slice/UserSlice";
import { useSessionStorageState } from "../../hooks/useSessionStorageState";
import {
  loadingState,
  startLoadingAction,
  stopLoadingAction,
} from "../../Slice/LoadingSlice";
import { setSelectedSectionIdAction } from "../../Slice/SectionSlice";
import { clearSnackbarAction } from "../../Slice/SnackbarSlice";
import FormLogo from "./FormLogo.png";
import OverflowWrapper from "../../Components/OverflowWrapper";
import { getBackgroundColor } from "../../utils/themeUtils";
import { sentenceCase, titleValidation } from "../../utils/questionUtils";

const Formlist = () => {
  const navigate = useNavigate();
  const [formId, setFormId] = useSessionStorageState("selectedFormId", null);
  const titleRef = useRef();
  const dispatch = useDispatch();

  const isLoading = useSelector(loadingState(FORM_LOADING_CONSTANT));

  // this is to reset the selected section which i needed in the questions page.
  useEffect(() => {
    dispatch(setSelectedSectionIdAction({ id: null }));
  }, [dispatch]);

  const handleFormClick = (arr, id) => {
    if (arr.length === 0) {
      raiseAlert(dispatch, NO_FORM_VERSIONS_MESSAGE, INFO_SEVERITY);
    } else {
      dispatch(clearSnackbarAction());
    }

    setFormId(id);
  };

  const closeFormVersions = () => {
    setFormId(null);
  };

  const defaultFormObj = () => {
    return {
      id: null,
      title: null,
    };
  };

  const [searchText, setSearchText] = useSessionStorageState("searchText", "");

  const [showCreateFormDialog, setShowCreateFormDialog] = useState(false);

  const [forms, setForms] = useState([]);

  const [formIdToDelete, setFormIdToDelete] = useState(null);

  const auth = useSelector(selectAuth);

  const [formObj, setFormObj] = useState(defaultFormObj);

  const [formTitleError, setFormTitleError] = useState(false);

  const cancelDelete = () => {
    setFormIdToDelete(null);
  };

  const handleCreateNewVersion = (id) => {
    api
      .post("/version", { formID: id })
      .then((resp) => {
        raiseAlert(
          dispatch,
          resp.data.data?.message ?? VERSION_CREATE_SUCCESS_MESSAGE,
          SUCCESS_SEVERITY
        );

        setForms((forms) => {
          return forms.map((form) => {
            if (form.id === id) {
              return {
                ...form,
                versions: [
                  ...form.versions,
                  {
                    versionID: resp.data.data.id,
                    versionCode: resp.data.data.versionCode,
                    isPublished: 0,
                  },
                ],
              };
            } else {
              return form;
            }
          });
        });
      })
      .catch((err) => {
        console.log("error : ", err);
        raiseAlert(
          dispatch,
          err.response.data?.message ?? VERSION_CREATION_FAILED_MESSAGE,
          ERROR_SEVERITY
        );
      });
  };

  useEffect(() => {
    const config = {
      headers: { Authorization: `Bearer ${auth.token}` },
    };
    dispatch(startLoadingAction(FORM_LOADING_CONSTANT));
    api
      .get("/forms", config)
      .then((resp) => {
        setForms(resp.data.data ?? []);
        dispatch(stopLoadingAction(FORM_LOADING_CONSTANT));
      })
      .catch((err) => {
        raiseAlert(
          dispatch,
          err.data?.message ?? FORM_FETCH_FAIL_ERROR_MESSAGE,
          ERROR_SEVERITY
        );
        dispatch(stopLoadingAction(FORM_LOADING_CONSTANT));
      });
  }, [dispatch, auth.token]);

  const filteredData = forms.filter((val) =>
    val.title.toLowerCase().includes(searchText.toLowerCase())
  );
  const selectedForm = filteredData.find((item) => item.id === formId);

  const openCreateFormDialog = () => {
    setShowCreateFormDialog(true);
    setFormTitleError(false);
  };
  const closeCreateFormDialog = () => {
    setShowCreateFormDialog(false);
    setFormTitleError(false);
  };

  const confirmDelete = () => {
    api
      .delete(`/forms/${formIdToDelete}`)
      .then(() => {
        raiseAlert(dispatch, FORM_DELETE_SUCCESS_MESSAGE, SUCCESS_SEVERITY);
        const updatedForms = forms.filter((form) => form.id !== formIdToDelete);
        setForms(updatedForms);
        setFormIdToDelete(null);
      })
      .catch((err) => {
        raiseAlert(
          dispatch,
          err.response.data?.message ?? FORM_DELETE_FAILURE_MESSAGE,
          ERROR_SEVERITY
        );
      });
  };

  const getMenuObj = (id, title) => {
    const menuObj = [
      {
        title: "Edit",
        icon: <EditIcon fontSize="small" color="primary" />,
        handler: () => {
          setFormObj({ id: id, title: title });
        },
      },
      {
        title: "Delete",
        icon: <DeleteIcon fontSize="small" color="error" />,
        handler: () => {
          setFormIdToDelete(id);
        },
      },
      {
        title: "Add New Version",
        icon: <AddIcon fontSize="small" color="success" />,
        handler: () => {
          handleCreateNewVersion(id);
        },
      },
    ];
    return menuObj;
  };

  const closeFormUpdateDialog = () => {
    setFormObj(defaultFormObj);
  };

  const handleFormCreate = () => {
    const titleHasError = titleValidation(titleRef.current.value);
    setFormTitleError(titleHasError);
    if (titleHasError) return;

    if (!validFormTitle(titleRef.current.value)) {
      raiseAlert(dispatch, TITLE_EMPTY_ERROR_MESSAGE, ERROR_SEVERITY);
      return;
    }
    api
      .post("/forms", { title: titleRef.current.value })
      .then((resp) => {
        raiseAlert(dispatch, FORM_CREATE_SUCCESS_MESSAGE, SUCCESS_SEVERITY);
        setForms((forms) => [
          ...forms,
          {
            id: resp.data.data.id,
            title: titleRef.current.value,
            versions: [],
          },
        ]);
        closeCreateFormDialog();
      })
      .catch((err) => {
        raiseAlert(
          dispatch,
          err.response.data?.message ?? FORM_CREATE_FAILURE_MESSAGE,
          ERROR_SEVERITY
        );
        console.log(err);
      });
  };

  const validFormTitle = () => {
    return titleRef.current.value !== "";
  };

  const handleFormUpdate = () => {
    const formTitle = titleRef.current.value;
    const titleHasError = titleValidation(formTitle);
    setFormTitleError(titleHasError);
    if (titleHasError) return;

    api
      .patch(`/forms/${formObj.id}`, { title: formTitle })
      .then(() => {
        raiseAlert(dispatch, "Form updated successfully", SUCCESS_SEVERITY);

        setForms((forms) => {
          return forms.map((form) => {
            if (form.id === formObj.id) {
              return { ...form, title: formTitle };
            }
            return form;
          });
        });

        setFormObj(defaultFormObj);
      })
      .catch((err) => {
        raiseAlert(
          dispatch,
          err.response.data?.message ??
          "Something went wrong , form title updation failed",
          ERROR_SEVERITY
        );
      });
  };

  const shouldShowVersions =
    selectedForm && selectedForm.versions && selectedForm.versions.length > 0;

  return (
    <Box
      sx={{
        height: `calc(100vh - ${NAVBAR_HEIGHT})`,
        display: "flex",
        flexDirection: "row",
        width: "100%",
        position: "relative",
      }}
    >
      <Box
        sx={{
          flexGrow: 1,
          justifySelf: "center",
          display: { sm: "block", xs: shouldShowVersions ? "none" : "block" },
          width: { xs: "100%", sm: `calc(100% - 350px)` },
          overflowY: "auto",
          transition: (theme) => ({
            xs: "",
            sm: theme.transitions.create("margin", {
              easing: theme.transitions.easing.sharp,
              duration: theme.transitions.duration.leavingScreen,
            }),
          }),
          ...(shouldShowVersions && {
            marginRight: `${VERSION_PANE_WIDTH}px`,
            transition: (theme) => ({
              xs: "",
              sm: theme.transitions.create("margin", {
                easing: theme.transitions.easing.easeOut,
                duration: theme.transitions.duration.enteringScreen,
              }),
            }),
          }),
        }}
      >
        <Box
          sx={{
            textAlign: "center",
            paddingTop: 2,
            paddingBottom: 1,
            top: "0px",
            position: "sticky",
            zIndex: 1,
            backgroundColor: getBackgroundColor,
          }}
        >
          <TextField
            sx={{ color: lightTheme.palette.primary.main }}
            value={searchText}
            onChange={(e) => setSearchText(e.target.value)}
            InputProps={{
              endAdornment: (
                <InputAdornment position="end">
                  <Search />
                </InputAdornment>
              ),
            }}
            type="search"
            id="search"
            label="Search"
          />
          <Button
            sx={{
              marginLeft: 5,
              marginTop: 1,
              color: "primary.main",
              display: { xs: "none", sm: "inline-flex" },
            }}
            size="medium"
            onClick={openCreateFormDialog}
            startIcon={<Add />}
          >
            {NEW_FORM_LABEL}
          </Button>
          <Fab
            sx={{
              display: { xs: "inline-flex", sm: "none" },
              position: "fixed",
              bottom: "15px",
              right: "15px",
            }}
            color="secondary"
            aria-label="add"
            onClick={openCreateFormDialog}
          >
            <AddIcon />
          </Fab>
        </Box>
        <Container
          sx={{
            paddingY: 2,
            width: "66.6%",
            ...(shouldShowVersions && { width: "80%" }),
          }}
        >
          {filteredData?.length === 0 ? (
            <EmptyComponent message="forms" isLoading={isLoading} />
          ) : (
            <Grid container spacing={3} data-testid="forms">
              {filteredData.map((value, i) => (
                <Grid item key={value.id} id={value.id} xs={12} sm={6} md={3}>
                  <StyledCard
                    elevation={2}
                    sx={{
                      border: selectedForm?.id === value.id ? "5px solid" : "",
                      borderColor: "secondary.main",
                      cursor: "pointer",
                      // "&:hover .form-card-footer": {
                      //   backgroundColor: "secondary.main",
                      // background: "cyan",
                      // background: "coral",
                      //   height: "100%",
                      // },
                    }}
                  >
                    <Grid container>
                      <Grid
                        item
                        xs={10}
                        sm={10}
                        md={10}
                        paddingLeft={"20px"}
                        onClick={() =>
                          handleFormClick(value.versions, value.id)
                        }
                        data-testid={`form${value.id}`}
                      >
                        <Button fullWidth sx={{ paddingTop: "15px" }}>
                          <img
                            src={FormLogo}
                            width={"85%"}
                            height={"85%"}
                            draggable="false"
                            alt="Form logo"
                          />
                        </Button>
                      </Grid>
                      <Grid item xs={2} sm={2} md={2} height={"100%"} data-testid={"formMenu"+value.id}>
                        <CustomMenu
                          menuObj={getMenuObj(value.id, value.title)}
                          iconColor={"white"}
                          id={value.id}
                        />
                      </Grid>
                    </Grid>
                    <CardContent
                      sx={{
                        flexGrow: 2,
                        position: "relative",
                      }}
                      onClick={() => handleFormClick(value.versions, value.id)}
                    >
                      <Box
                        className="form-card-footer"
                        sx={{
                          width: "100%",
                          height: "0%",
                          position: "absolute",
                          bottom: "0px",
                          left: "0px",
                          zIndex: "-1",
                          transition: "height 0.5s",
                          transitionTimingFunction: "ease-in-out",
                        }}
                      />
                      <OverflowWrapper
                        element={
                          <Typography
                            gutterBottom
                            variant="h6"
                            component="h3"
                            sx={{
                              textAlign: "center",
                              zIndex: 3,
                              color: "black",
                            }}
                          >
                            {sentenceCase(value.title)}
                          </Typography>
                        }
                        sx={{ width: "100%" }}
                      />
                    </CardContent>
                  </StyledCard>
                </Grid>
              ))}
            </Grid>
          )}
        </Container>
      </Box>
      <Box
        sx={{
          height: `calc(100vh - ${NAVBAR_HEIGHT})`,
          overflowY: "auto",
          justifyContent: "center",
          borderLeft: "2px solid lightgrey",
          zIndex: 10,
          position: "absolute",
          top: 0,
          right: 0,
          width: "0px",
          transition: (theme) => ({
            xs: "",
            sm: theme.transitions.create("width", {
              easing: theme.transitions.easing.sharp,
              duration: theme.transitions.duration.leavingScreen,
            }),
          }),
          ...(shouldShowVersions && {
            transition: (theme) => ({
              xs: "",
              sm: theme.transitions.create("width", {
                easing: theme.transitions.easing.easeOut,
                duration: theme.transitions.duration.enteringScreen,
              }),
            }),
            width: { xs: "100%", sm: `${VERSION_PANE_WIDTH}px` },
          }),
        }}
      >
        {shouldShowVersions && (
          <>
            <Box
              sx={{
                position: "sticky",
                top: "0px",
                display: "flex",
                justifyContent: "center",
                zIndex: "5",
                pt: 2,
                backgroundColor: getBackgroundColor,
              }}
            >
              <Typography
                sx={{
                  textAlign: "center",
                  fontSize: "28px",
                  flexGrow: "1",
                  position: "relative",
                  left: "25px",
                  color: "primary.main",
                }}
              >
                {VERSION_LABEL}
              </Typography>
              <IconButton onClick={closeFormVersions} data-testid="versions-close">
                <CloseIcon />
              </IconButton>
            </Box>
            <Box>
              {selectedForm.versions.map((v) => (
                <Timeline
                  position="right"
                  sx={{ justifyContent: "left" }}
                  key={v.versionID}
                >
                  <Box>
                    <TimelineItem color="black">
                      <TimelineSeparator color="black">
                        <Button
                          onClick={() => {
                            navigate(`${formId}/versions/${v.versionID}`);
                          }}
                          data-testid={"version"+v.versionID}
                        >
                          {v.isPublished ? (
                            <TimelineDot
                              sx={{
                                backgroundColor: "primary.main",
                              }}
                            />
                          ) : (
                            <TimelineDot />
                          )}
                        </Button>
                        <TimelineConnector />
                      </TimelineSeparator>
                      <TimelineContent sx={{ marginTop: "10px" }}>
                        {v.versionCode}
                      </TimelineContent>
                    </TimelineItem>
                  </Box>
                </Timeline>
              ))}
            </Box>
          </>
        )}
      </Box>
      <CustomDialog
        open={formObj.id != null}
        closeFn={closeFormUpdateDialog}
        title={UPDATE_FORM_DIALOG_TITLE}
        content={CREATE_FORM_DIALOG_CONTENT}
        inputElement={
          <>
            <TextField
              autoFocus
              margin="dense"
              id="formName"
              label="Form title"
              defaultValue={formObj.title}
              type="text"
              fullWidth
              variant="standard"
              inputRef={titleRef}
              onChange={(e) => {
                if (formTitleError) {
                  setFormTitleError(titleValidation(e.target.value));
                }
              }}
              onBlur={() => {
                setTimeout(
                  () =>
                    setFormTitleError(titleValidation(titleRef.current.value)),
                  1
                );
              }}
              onKeyDown={(e) => {
                if (e.key === "Enter" || e.key === "NumpadEnter") {
                  handleFormUpdate();
                }
              }}
            />
            {formTitleError && TITLE_ERROR_MESSAGE}
          </>
        }
        dialogButtons={[
          new DialogButton(
            "Cancel",
            { color: "primary.main" },
            closeFormUpdateDialog
          ),
          new DialogButton(
            "Update",
            { color: "success.main" },
            handleFormUpdate,
            true
          ),
        ]}
      />
      <CustomDialog
        open={formIdToDelete !== null}
        closeFn={cancelDelete}
        title={DELETE_DIALOG_TITLE}
        content={DELETE_DIALOG_CONTENT}
        dialogButtons={[
          new DialogButton("Delete", { color: "error.main" }, confirmDelete),
          new DialogButton(
            "Cancel",
            { color: "primary.main" },
            cancelDelete,
            true
          ),
        ]}
      />
      <CustomDialog
        open={showCreateFormDialog}
        closeFn={closeCreateFormDialog}
        title={CREATE_FORM_DIALOG_TITLE}
        content={CREATE_FORM_DIALOG_CONTENT}
        inputElement={
          <>
            <TextField
              autoFocus
              margin="dense"
              id="formName"
              label="Form title"
              type="text"
              fullWidth
              variant="standard"
              inputRef={titleRef}
              onKeyDown={(e) => {
                if (e.key === "Enter" || e.key === "NumpadEnter") {
                  handleFormCreate();
                }
              }}
              onChange={(e) => {
                if (formTitleError) {
                  setFormTitleError(titleValidation(e.target.value));
                }
              }}
              onBlur={() => {
                setTimeout(
                  () =>
                    setFormTitleError(titleValidation(titleRef.current.value)),
                  1
                );
              }}
            />
            {formTitleError && TITLE_ERROR_MESSAGE}
          </>
        }
        dialogButtons={[
          new DialogButton(
            "Cancel",
            { color: "primary.main" },
            closeCreateFormDialog
          ),
          new DialogButton(
            "Create",
            { color: "success.main" },
            handleFormCreate,
            true
          ),
        ]}
      />
    </Box>
  );
};

export default Formlist;
