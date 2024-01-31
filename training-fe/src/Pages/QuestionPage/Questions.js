import { useEffect, useRef, useState, useMemo, useCallback } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useLocation } from "react-router";
import { useParams, useNavigate } from "react-router-dom";
import {
  closeSectionPaneAction,
  deleteSectionAction,
  editSectionAction,
  resetToDefaultAction,
  selectIsSectionPaneOpen,
  selectPageNumber,
  selectQuestionCountInLastPage,
  selectSelectedSectionId,
  selectTotalPages,
  setSectionsAction,
  updatePageNumberAction,
  updateQuestionsCountInLastPageAction,
  updateTotalPagesAction,
} from "../../Slice/SectionSlice";
import {
  CHILD_QUESTION_ADD_WARNING_CONTENT,
  CREATE_SECTION_DIALOG_CONTENT,
  CREATE_SECTION_DIALOG_TITLE,
  DELETE_DIALOG_CONTENT,
  DELETE_DIALOG_TITLE,
  EMPTY_QUESTION_OBJECT,
  SECTION_CREATE_FAIL_ERROR_MESSAGE,
  SECTION_UPDATE_FAIL_ERROR_MESSAGE,
  UPDATE_SECTION_DIALOG_CONTENT,
  UPDATE_SECTION_DIALOG_TITLE,
  VERSION_PUBLISH_FAIL_ERROR_MESSAGE,
  VERSION_PUBLISHED_SUCCESS,
  VERSION_DELETE_SUCCESS_MESSAGE,
  VERSION_DELETE_FAILURE_MESSAGE,
  DELETE_VERSION_DIALOG_TITLE,
  DELETE_VERSION_DIALOG_CONTENT,
  QUESTION_CREATION_SUCCESS,
  QUESTION_CREATION_FAILURE_ERROR_MESSAGE,
  QUESTION_UPDATE_FAILURE_ERROR_MESSAGE,
  SECTION_FETCH_ERROR,
  QUESTION_DELETION_SUCCESS,
  QUESTION_DELETION_FAILED,
  QUESTIONS_PER_PAGE,
  DELETE_SECTION_DIALOG_TITLE,
  DELETE_SECTION_DIALOG_CONTENT,
  SECTION_DELETE_SUCCESS_MESSAGE,
  SECTION_DELETE_FAIL_ERROR_MESSAGE,
  QUESTION_LOADING_KEY,
  SECTION_LOADING_KEY,
  TEXT_TYPE,
  INTEGER_TYPE,
  EMPTY_SECTIONS_PUBLISH_ERROR_MESSAGE,
} from "./Questions.Constants";
import { Box } from "@mui/system";
import QuestionItem from "./Components/QuestionItem";
import { useSessionStorageState } from "../../hooks/useSessionStorageState";
import { v4 as uuid } from "uuid";
import {
  Divider,
  IconButton,
  List,
  Pagination,
  TextField,
  Typography,
} from "@mui/material";
import {
  DRAWER_WIDTH,
  ERROR_SEVERITY,
  NAVBAR_HEIGHT,
  SUCCESS_SEVERITY,
} from "../../Constants";
import SectionsPane from "./Components/SectionsPane";
import CheckIcon from "@mui/icons-material/Check";
import CloseIcon from "@mui/icons-material/Close";
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";
import ActionButton from "./Components/ActionButton";
import CustomDialog, { DialogButton } from "../../Components/CustomDialog";
import {
  FORM_FETCH_FAIL_ERROR_MESSAGE,
  TITLE_ERROR_MESSAGE,
} from "../FormslistingPage/Formslist.Constants";
import { api } from "../../utils/apiMethods";
import { raiseAlert } from "../../utils/snackbarUtils";
import { addSectionAction, selectSections } from "../../Slice/SectionSlice";
import EmptyComponent from "../EmptyPage/EmptyComponent";
import {
  startLoadingAction,
  stopLoadingAction,
} from "../../Slice/LoadingSlice";
import { loadingState } from "../../Slice/LoadingSlice";
import AddCircleIcon from "@mui/icons-material/AddCircle";
import { getBackgroundColor } from "../../utils/themeUtils";
import { selectAuth } from "../../Slice/UserSlice";
import { titleValidation } from "../../utils/questionUtils";

function Questions() {
  const location = useLocation();
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const sections = useSelector(selectSections);

  const { formId: formIdInString, versionId: versionIdInString } = useParams();
  const formId = Number(formIdInString);
  const versionId = Number(versionIdInString);
  const selectedSectionId = useSelector(selectSelectedSectionId);
  const isQuestionsLoading = useSelector(loadingState(QUESTION_LOADING_KEY));

  const validateFormIdAndVersionId = useCallback(
    (formId, versionId) => {
      api
        .get("/forms", {
          headers: { Authorization: `Bearer ${auth.token}` },
        })
        .then((resp) => {
          const forms = resp.data.data;
          if (forms.every((form) => form.id !== formId)) {
            raiseAlert(dispatch, "Invalid form id", ERROR_SEVERITY);
            navigate("/error");
            return;
          }
          const form = forms.find((form) => form.id === formId);
          if (
            form.versions.every((version) => version.versionID !== versionId)
          ) {
            raiseAlert(dispatch, "Invalid version id", ERROR_SEVERITY);
            navigate("/error");
            return;
          }
        })
        .catch((err) => {
          console.log(err);
          raiseAlert(
            dispatch,
            err.data?.message ?? FORM_FETCH_FAIL_ERROR_MESSAGE,
            ERROR_SEVERITY
          );
        });
    },
    [dispatch, navigate]
  );

  useEffect(() => {
    validateFormIdAndVersionId(formId, versionId);
    dispatch(startLoadingAction(SECTION_LOADING_KEY));

    api
      .get(`sections`, {
        params: { versionID: versionId },
        headers: { Authorization: `Bearer ${auth.token}` },
      })
      .then((resp) => {
        dispatch(setSectionsAction({ sections: resp.data?.data ?? [] }));
        dispatch(stopLoadingAction(SECTION_LOADING_KEY));
      })
      .catch((err) => {
        console.log(err);
        raiseAlert(
          dispatch,
          err.response.data?.message ?? SECTION_FETCH_ERROR,
          ERROR_SEVERITY
        );
        dispatch(stopLoadingAction(SECTION_LOADING_KEY));
      });

    const handleBeforeUnload = () => {
      // Invoke function before leaving the page
      dispatch(resetToDefaultAction());
    };
    window.addEventListener("beforeunload", handleBeforeUnload);
    return () => {
      window.removeEventListener("beforeunload", handleBeforeUnload);
      dispatch(resetToDefaultAction());
    };
  }, [location, dispatch, formId, validateFormIdAndVersionId, versionId]);

  const [questions, setQuestions] = useState([]);
  const [questionIdToDelete, setQuestionIdToDelete] = useState(null);
  const [questionsInEditMode, setQuestionsInEditMode] = useSessionStorageState(
    "questionsInUpdateMode",
    {}
  );
  // errors is a structure which is a map of id -> obj.
  // obj hold all the errors associated with the question with id
  const [errors, setErrors] = useSessionStorageState("errors", {});
  const [sectionTitleHasError, setSectionTitleHasError] = useState(false);

  const defaultErrorState = {
    questionText: [],
    options: [],
    questionType: [],
    relationalOperation: [],
    correctResponse: [],
  };

  const [newQuestions, setNewQuestions] = useSessionStorageState(
    "newQuestions",
    {}
  );

  const [showSectionCreateDialog, setShowSectionCreateDialog] = useState(false);
  const currentPage = useSelector(selectPageNumber);
  const totalPages = useSelector(selectTotalPages);

  const auth = useSelector(selectAuth);

  //this is a method which we can use to update the error state
  //the errorData can be complete or partial.
  const updateErrorState = (id, errorData) => {
    setErrors((errors) => ({
      ...errors,
      [id]: { ...(errors[id] ?? []), ...errorData },
    }));
  };

  // this is a method which helps to remove the
  // error state for a given questionID.
  const removeErrorState = (id) => {
    setErrors((errors) => {
      const { [id]: errorDataPlaceholder, ...rest } = errors;
      return rest;
    });
  };

  const newQuestionsOfCurrentSection = (newQuestions[null] ?? []).filter(
    (question) => question.sectionId === selectedSectionId
  );

  const updateQuestionsCountInLastPage = (lastPageNumber) => {
    api
      .get("questions", {
        params: { id: selectedSectionId, page: lastPageNumber },
        headers: { Authorization: `Bearer ${auth.token}` },
      })
      .then((resp) => {
        dispatch(
          updateQuestionsCountInLastPageAction(resp.data.data.questions.length)
        );
      })
      .catch((err) => {
        console.error(err);
      });
  };

  const refetchQuestions = () => {
    if (selectedSectionId === 0) {
      setQuestions([]);
      return;
    }
    if (selectedSectionId && currentPage) {
      dispatch(startLoadingAction(QUESTION_LOADING_KEY));
      api
        .get("questions", {
          params: { id: selectedSectionId, page: currentPage },
          headers: { Authorization: `Bearer ${auth.token}` },
        })
        .then((resp) => {
          dispatch(updateTotalPagesAction(resp.data.data.pages));
          updateQuestionsCountInLastPage(resp.data.data.pages);
          setQuestions(resp.data.data.questions);
          dispatch(stopLoadingAction(QUESTION_LOADING_KEY));
        })
        .catch((err) => {
          console.error(err);
          if (err.response.data.message === "Invalid Page Number") {
            if (currentPage === 1) {
              dispatch(updateTotalPagesAction(0));
              dispatch(updateQuestionsCountInLastPageAction(0));
            } else if (
              currentPage > 1 &&
              newQuestionsOfCurrentSection.length === 0
            ) {
              dispatch(updatePageNumberAction({ pageNumber: currentPage - 1 }));
            }
          }
          setQuestions([]);
          dispatch(stopLoadingAction(QUESTION_LOADING_KEY));
        });
    }
  };

  useEffect(() => {
    refetchQuestions();
    // eslint-disable-next-line
  }, [selectedSectionId, currentPage]);

  const [showSectionUpdateDialog, setShowSectionUpdateDialog] = useState(false);
  const [showVersionDeleteDialog, setShowVersionDeleteDialog] = useState(false);
  const [showSectionDeleteDialog, setShowSectionDeleteDialog] = useState(false);

  const isSectionsPaneOpen = useSelector(selectIsSectionPaneOpen);

  const questionCountInLastPage = useSelector(selectQuestionCountInLastPage);

  const sectionTitleRef = useRef();

  const newTotalPage = (newQuestionsOfCurrentSectionLength) =>
    totalPages === 0
      ? Math.ceil(newQuestionsOfCurrentSectionLength / QUESTIONS_PER_PAGE)
      : totalPages -
        1 +
        Math.ceil(
          (questionCountInLastPage + newQuestionsOfCurrentSectionLength) /
            QUESTIONS_PER_PAGE
        );

  const openSectionCreateDialog = () => {
    setShowSectionCreateDialog(true);
    setSectionTitleHasError(false);
  };
  const closeSectionCreateDialog = () => {
    setShowSectionCreateDialog(false);
    setSectionTitleHasError(false);
  };

  const openSectionUpdateDialog = () => {
    setShowSectionUpdateDialog(true);
  };
  const openSectionDeleteDialog = () => {
    setShowSectionDeleteDialog(true);
  };
  const closeSectionDeleteDialog = () => {
    setShowSectionDeleteDialog(false);
  };
  const closeSectionUpdateDialog = () => {
    setShowSectionUpdateDialog(false);
  };

  const openVersionDeleteDialog = () => {
    setShowVersionDeleteDialog(true);
  };

  const closeVersionDeleteDialog = () => {
    setShowVersionDeleteDialog(false);
  };

  const selectedSectionTitle = useMemo(() => {
    return sections?.find((section) => section.id === selectedSectionId)?.title;
  }, [sections, selectedSectionId]);

  const updateQuestionInEditMode = (id, data) => {
    // this is a common place of the adding and editing the question
    // so we can set the error state for the both here itself.

    const err = errors[id];
    if (!err) {
      updateErrorState(id, defaultErrorState);
    }
    setQuestionsInEditMode((prev) => {
      const currentQuestionState = prev[id] ?? {};
      return { ...prev, [id]: { ...currentQuestionState, ...data } };
    });
  };

  const cancelUpdateForQuestion = (id) => {
    if (typeof id === "string") {
      const questionToDelete = questionsInEditMode[id];
      const parentId = questionToDelete.relatedTo;
      // setNewQuestions((prev) => ({

      // }));
      setNewQuestions((prev) => {
        if (prev[parentId].length === 1) {
          const { [parentId]: tempNewQuestions, ...rest } = prev;
          return rest;
        } else {
          return {
            ...prev,
            [parentId]: prev[parentId].filter(
              (question) => question.id !== questionToDelete.id
            ),
          };
        }
      });
    }
    setQuestionsInEditMode((prev) => {
      const { [id]: questionToCancel, ...rest } = prev;
      return rest;
    });

    removeErrorState(id);
  };

  const generateNewQuestion = (parentId, sectionId = null) => {
    return {
      ...EMPTY_QUESTION_OBJECT,
      id: uuid(),
      sectionId,
      relatedTo: parentId,
    };
  };
  const childrenCount = (questions, id) => {
    const question = questions.find((q) => q.id === id);
    if (question) return question.childQuestions.length;
    for (let i = 0; i < questions.length; i++) {
      const ans = childrenCount(questions[i].childQuestions, id);
      if (ans) return ans;
    }
    return null;
  };

  const addNewQuestion = (parentId) => {
    if (parentId !== null) {
      const currentChildrenCount = childrenCount(questions, parentId);
      const newChildrenCount = (newQuestions[parentId] ?? []).length;
      const totalChildrenCount = currentChildrenCount + newChildrenCount;
      if (totalChildrenCount >= 3) {
        raiseAlert(
          dispatch,
          CHILD_QUESTION_ADD_WARNING_CONTENT,
          ERROR_SEVERITY
        );
        return;
      }
    } else {
      dispatch(
        updatePageNumberAction({
          pageNumber: newTotalPage(newQuestionsOfCurrentSection.length + 1),
        })
      );
    }

    const newQuestion = generateNewQuestion(parentId, selectedSectionId);
    setNewQuestions((prev) => ({
      ...prev,
      [parentId]: [...(prev[parentId] ?? []), newQuestion],
    }));
    updateQuestionInEditMode(newQuestion.id, newQuestion);
  };
  const cancelDelete = () => {
    setQuestionIdToDelete(null);
  };

  const confirmDelete = () => {
    api
      .delete(`questions/${questionIdToDelete}`)
      .then(() => {
        raiseAlert(dispatch, QUESTION_DELETION_SUCCESS);
        refetchQuestions();
        setQuestionIdToDelete(null);
      })
      .catch((err) => {
        console.log(err, "error object");
        raiseAlert(
          dispatch,
          err.response.data?.message ?? QUESTION_DELETION_FAILED,
          ERROR_SEVERITY
        );
      });
  };

  const getQuestionData = (questionData) => {
    if (
      questionData.questionType === TEXT_TYPE ||
      questionData.questionType === INTEGER_TYPE
    ) {
      return (({ id, childQuestions, options, ...rest }) => rest)(questionData);
    } else {
      return (({ id, childQuestions, ...rest }) => rest)(questionData);
    }
  };

  const confirmUpdateForQuestion = (id) => {
    var questionData = {};

    if (typeof id === "string") {
      // deleted from the new questions state.
      // this is for new question creation.
      const parentId = questionsInEditMode[id].relatedTo;
      questionData = {
        ...questionsInEditMode[id],
      };
      questionData = getQuestionData(questionData);
      api
        .post("/questions", questionData)
        .then((resp) => {
          raiseAlert(dispatch, QUESTION_CREATION_SUCCESS);
          setNewQuestions((prev) => {
            return {
              ...prev,
              [parentId]: prev[parentId].filter(
                (question) => question.id !== id
              ),
            };
          });
          refetchQuestions();
          setQuestionsInEditMode((prev) => {
            delete prev[id];
            return { ...prev };
          });
        })
        .catch((err) => {
          raiseAlert(
            dispatch,
            err.response.data?.message ??
              QUESTION_CREATION_FAILURE_ERROR_MESSAGE,
            ERROR_SEVERITY
          );
        });
    } else {
      // this is for updation.
      questionData = {
        ...questionsInEditMode[id],
        sectionId: selectedSectionId,
      };

      questionData = getQuestionData(questionData);

      api
        .put(`/questions/${id}`, questionData)
        .then((resp) => {
          raiseAlert(dispatch, resp.data.message);
          refetchQuestions();
          setQuestionsInEditMode((prev) => {
            delete prev[id];
            return { ...prev };
          });
        })
        .catch((err) => {
          raiseAlert(
            dispatch,
            err.response.data?.message ?? QUESTION_UPDATE_FAILURE_ERROR_MESSAGE,
            ERROR_SEVERITY
          );
        });
    }
  };

  const handleSectionCreate = () => {
    const sectionTitle = sectionTitleRef.current.value;
    const hasError = titleValidation(sectionTitle);
    setSectionTitleHasError(hasError);
    if (hasError) {
      return;
    }

    api
      .post("/sections", { versionId, title: sectionTitle })
      .then((resp) => {
        dispatch(
          addSectionAction({ id: resp.data.data.id, title: sectionTitle })
        );
        raiseAlert(dispatch, resp.data.message, SUCCESS_SEVERITY);
        setShowSectionCreateDialog(false);
      })
      .catch((err) => {
        raiseAlert(
          dispatch,
          err.response.data?.message ?? SECTION_CREATE_FAIL_ERROR_MESSAGE,
          ERROR_SEVERITY
        );
        console.log(err);
      });
  };

  const handleSectionDelete = () => {
    api
      .delete(`/sections/${selectedSectionId}`)
      .then(() => {
        dispatch(deleteSectionAction({ id: selectedSectionId }));
        raiseAlert(dispatch, SECTION_DELETE_SUCCESS_MESSAGE, SUCCESS_SEVERITY);
        setShowSectionDeleteDialog(false);
      })
      .catch((err) => {
        raiseAlert(
          dispatch,
          err.response.data?.message ?? SECTION_DELETE_FAIL_ERROR_MESSAGE,
          ERROR_SEVERITY
        );
      });
  };

  const handleSectionPaneClose = () => {
    dispatch(closeSectionPaneAction());
  };

  const handleVersionPublish = () => {
    if (sections.length === 0) {
      raiseAlert(
        dispatch,
        EMPTY_SECTIONS_PUBLISH_ERROR_MESSAGE,
        ERROR_SEVERITY
      );
    } else {
      api
        .put("/version", {
          versionID: versionId,
        })
        .then((resp) => {
          raiseAlert(dispatch, VERSION_PUBLISHED_SUCCESS);
          navigate("/forms");
        })
        .catch((err) => {
          raiseAlert(
            dispatch,
            err.response.data?.message ?? VERSION_PUBLISH_FAIL_ERROR_MESSAGE,
            ERROR_SEVERITY
          );
        });
    }
  };

  const handlePageChange = (e, pageNumber) => {
    dispatch(updatePageNumberAction({ pageNumber }));
  };
  const handleSectionUpdate = () => {
    const sectionTitle = sectionTitleRef.current.value;
    const hasError = titleValidation(sectionTitle);
    setSectionTitleHasError(hasError);
    if (hasError) {
      return;
    }

    api
      .patch(`/sections/${selectedSectionId}`, { title: sectionTitle })
      .then((resp) => {
        raiseAlert(dispatch, resp.data.message, SUCCESS_SEVERITY);
        dispatch(
          editSectionAction({ id: selectedSectionId, title: sectionTitle })
        );
        setShowSectionUpdateDialog(false);
      })
      .catch((err) => {
        console.log(err);
        raiseAlert(
          dispatch,
          err.response.data?.message ?? SECTION_UPDATE_FAIL_ERROR_MESSAGE,
          ERROR_SEVERITY
        );
        console.log(err);
      });
  };

  const paginatedQuestions = useMemo(() => {
    if (currentPage < totalPages) {
      return questions;
    } else if (currentPage === totalPages) {
      return [
        ...questions,
        ...newQuestionsOfCurrentSection.slice(
          undefined,
          QUESTIONS_PER_PAGE - questionCountInLastPage
        ),
      ];
    } else {
      const offset =
        questionCountInLastPage === 0
          ? 0
          : QUESTIONS_PER_PAGE - questionCountInLastPage;
      const page = currentPage - totalPages;
      const res = newQuestionsOfCurrentSection.slice(
        offset + QUESTIONS_PER_PAGE * (page - 1),
        offset + QUESTIONS_PER_PAGE * page
      );
      if (res.length === 0 && currentPage > 1)
        dispatch(updatePageNumberAction({ pageNumber: currentPage - 1 }));
      return res;
    }
  }, [
    questions,
    currentPage,
    totalPages,
    questionCountInLastPage,
    dispatch,
    newQuestionsOfCurrentSection,
  ]);

  const paginationRef = useRef(null);

  const handleVersionDelete = () => {
    closeVersionDeleteDialog();
    api
      .delete(`/version/${versionId}`)
      .then((resp) => {
        raiseAlert(dispatch, VERSION_DELETE_SUCCESS_MESSAGE, SUCCESS_SEVERITY);
        navigate("/forms");
      })
      .catch((err) => {
        raiseAlert(
          dispatch,
          err.data?.message ?? VERSION_DELETE_FAILURE_MESSAGE,
          ERROR_SEVERITY
        );
        console.log(err);
      });
  };

  return (
    <Box
      sx={{
        width: "100%",
        display: "flex",
        flexDirection: "row",
        position: "relative",
      }}
    >
      <Box
        sx={{
          width: { xs: "100%", sm: DRAWER_WIDTH },
          top: "0px",
          left: "0px",
          zIndex: 10,
          position: { xs: "absolute", sm: "static" },
          borderRight: "1px solid black",
          display: { xs: isSectionsPaneOpen ? "block" : "none", sm: "block" },
          background: getBackgroundColor,
        }}
      >
        <Box
          sx={{
            height: `calc(100vh - ${NAVBAR_HEIGHT})`,
            display: "flex",
            flexDirection: "column",
            position: "relative",
          }}
        >
          <Box
            display={"flex"}
            justifyContent={"center"}
            alignContent={"center"}
            position={"relative"}
          >
            <Typography variant="h6" sx={{ textAlign: "center", pt: 1 }}>
              Sections
            </Typography>
            <IconButton
              sx={{
                color: "primary.main",
                right: "0",
                position: "absolute",
              }}
              onClick={openSectionCreateDialog}
            >
              <AddCircleIcon
                sx={{ color: "primary.main", fontSize: "1.8rem" }}
              />
            </IconButton>
            <IconButton
              sx={{
                position: "absolute",
                top: "5px",
                left: "6px",
                zIndex: 10,
                display: { xs: "block", sm: "none" },
              }}
              onClick={handleSectionPaneClose}
            >
              <CloseIcon />
            </IconButton>
          </Box>
          <Box
            sx={{
              alignSelf: "flex-start",
              flexGrow: "1",
              width: "100%",
              overflowY: "auto",
            }}
          >
            <SectionsPane
              addQuestionHandler={() => {
                handleSectionPaneClose();
                addNewQuestion(null);
              }}
              editSectionHandler={openSectionUpdateDialog}
              deleteSectionHandler={openSectionDeleteDialog}
            />
          </Box>
          <List sx={{ alignSelf: "flex-end", width: "100%" }}>
            <Divider />
            <ActionButton
              title={"Delete version"}
              icon={<CloseIcon />}
              sx={{ color: "error.main" }}
              onClick={openVersionDeleteDialog}
            />
            <ActionButton
              title={"Publish version"}
              icon={<CheckIcon />}
              sx={{ color: "success.main" }}
              onClick={handleVersionPublish}
            />
          </List>
        </Box>
      </Box>
      {paginatedQuestions.length === 0 || isQuestionsLoading ? (
        <EmptyComponent message="Questions" isLoading={isQuestionsLoading} />
      ) : (
        <Box
          sx={{
            width: { xs: "100%", sm: `calc(100% -${DRAWER_WIDTH})` },
            height: `calc(100vh - ${NAVBAR_HEIGHT})`,
            overflow: "auto",
            display: "flex",
            flexDirection: "column",
            justifyContent: "space-between",
          }}
        >
          <Box>
            <QuestionItem
              questionsArray={paginatedQuestions}
              depth={0}
              questionsInEditMode={questionsInEditMode}
              updateQuestionInEditmode={updateQuestionInEditMode}
              cancelUpdateForQuestion={cancelUpdateForQuestion}
              confirmUpdateForQuestion={confirmUpdateForQuestion}
              parentData={{ id: null, options: null, type: null }}
              newQuestions={newQuestions}
              addNewQuestionHandler={addNewQuestion}
              setQuestionIdToDelete={setQuestionIdToDelete}
              errors={errors}
              updateErrorState={updateErrorState}
            />
          </Box>
          <Pagination
            count={newTotalPage(newQuestionsOfCurrentSection.length)}
            color="primary"
            page={currentPage}
            onChange={handlePageChange}
            shape="rounded"
            showFirstButton
            showLastButton
            sx={{ mx: "auto", my: 1 }}
            ref={paginationRef}
          />
          <IconButton
            sx={{
              position: "absolute",
              bottom: "20px",
              right: "20px",
              background: "rgba(0,0,0,0.2)",
              "&:hover": {
                background: "rgba(0,0,0,0.7)",
                color: "white",
              },
            }}
            onClick={() =>
              paginationRef.current?.scrollIntoView({ behavior: "smooth" })
            }
          >
            <ExpandMoreIcon />
          </IconButton>
        </Box>
      )}
      <CustomDialog
        open={questionIdToDelete !== null}
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
        open={showSectionCreateDialog}
        closeFn={closeSectionCreateDialog}
        title={CREATE_SECTION_DIALOG_TITLE}
        content={CREATE_SECTION_DIALOG_CONTENT}
        inputElement={
          <>
            <TextField
              autoFocus
              margin="dense"
              id="sectionName"
              label="Section title"
              type="text"
              fullWidth
              variant="standard"
              onChange={(e) => {
                if (sectionTitleHasError) {
                  setSectionTitleHasError(titleValidation(e.target.value));
                }
              }}
              onBlur={() => {
                setTimeout(
                  () =>
                    setSectionTitleHasError(
                      titleValidation(sectionTitleRef.current.value)
                    ),
                  1
                );
              }}
              inputRef={sectionTitleRef}
              onKeyDown={(e) => {
                if (e.key === "Enter" || e.key === "NumpadEnter") {
                  handleSectionCreate();
                }
              }}
            />
            {sectionTitleHasError && TITLE_ERROR_MESSAGE}
          </>
        }
        dialogButtons={[
          new DialogButton(
            "Cancel",
            { color: "primary.main" },
            closeSectionCreateDialog
          ),
          new DialogButton(
            "Create",
            { color: "success.main" },
            handleSectionCreate,
            true
          ),
        ]}
      />
      <CustomDialog
        open={showSectionUpdateDialog}
        closeFn={closeSectionUpdateDialog}
        title={UPDATE_SECTION_DIALOG_TITLE}
        content={UPDATE_SECTION_DIALOG_CONTENT}
        inputElement={
          <>
            <TextField
              autoFocus
              margin="dense"
              id="sectionName"
              label="Section title"
              type="text"
              fullWidth
              variant="standard"
              defaultValue={selectedSectionTitle}
              inputRef={sectionTitleRef}
              onChange={(e) => {
                if (sectionTitleHasError) {
                  setSectionTitleHasError(titleValidation(e.target.value));
                }
              }}
              onBlur={() => {
                setTimeout(
                  () =>
                    setSectionTitleHasError(
                      titleValidation(sectionTitleRef.current.value)
                    ),
                  1
                );
              }}
              onKeyDown={(e) => {
                if (e.key === "Enter" || e.key === "NumpadEnter") {
                  handleSectionUpdate();
                }
              }}
            />
            {sectionTitleHasError && TITLE_ERROR_MESSAGE}
          </>
        }
        dialogButtons={[
          new DialogButton(
            "Cancel",
            { color: "primary.main" },
            closeSectionUpdateDialog
          ),
          new DialogButton(
            "Update",
            { color: "success.main" },
            handleSectionUpdate,
            true
          ),
        ]}
      />
      <CustomDialog
        open={showSectionDeleteDialog}
        closeFn={closeSectionDeleteDialog}
        title={DELETE_SECTION_DIALOG_TITLE}
        content={DELETE_SECTION_DIALOG_CONTENT}
        dialogButtons={[
          new DialogButton(
            "Cancel",
            { color: "primary.main" },
            closeSectionDeleteDialog
          ),
          new DialogButton(
            "Delete",
            { color: "error.main" },
            handleSectionDelete,
            true
          ),
        ]}
      />
      <CustomDialog
        open={showVersionDeleteDialog}
        closeFn={closeVersionDeleteDialog}
        title={DELETE_VERSION_DIALOG_TITLE}
        content={DELETE_VERSION_DIALOG_CONTENT}
        dialogButtons={[
          new DialogButton(
            "Cancel",
            { color: "primary.main" },
            closeVersionDeleteDialog
          ),
          new DialogButton(
            "Delete",
            { color: "error.main" },
            handleVersionDelete,
            true
          ),
        ]}
      />
    </Box>
  );
}
export default Questions;
