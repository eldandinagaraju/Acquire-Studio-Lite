import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  selectedSectionId: JSON.parse(sessionStorage.getItem("selectedSectionId")),
  sections: [],
  isSectionPaneOpen: false,
  currentPageNumber:
    JSON.parse(sessionStorage.getItem("currentPageNumber")) ?? 1,
  questionsCountInLastPage:
    JSON.parse(sessionStorage.getItem("questionsCountInLastPage")) ?? 0,
  totalPages: JSON.parse(sessionStorage.getItem("totalPages")) ?? 0,
};

export const sectionSlice = createSlice({
  name: "formSections",
  initialState,
  reducers: {
    setSections: (state, action) => {
      state.sections = action.payload.sections;
      if (
        state.sections.length > 0 &&
        (!state.selectedSectionId ||
          (state.selectedSectionId &&
            state.sections.every(
              (section) => section.id !== state.selectedSectionId
            )))
      ) {
        sectionSlice.caseReducers.setSelectedSectionId(state, {
          payload: { id: action.payload.sections[0].id },
        });
      }
    },
    addSection: function (state, action) {
      const id = action.payload.id;
      const title = action.payload.title;
      if (id && title) {
        state.sections.push({ id, title });
      }
    },
    editSection: (state, action) => {
      const updatedSections = state.sections.map((section) => {
        if (section.id === action.payload.id) {
          return { ...section, title: action.payload.title };
        }
        return section;
      });
      state.sections = updatedSections;
    },
    deleteSection: (state, action) => {
      const currentSectionIndex = state.sections.findIndex(
        (section) => section.id === state.selectedSectionId
      );

      sectionSlice.caseReducers.setSelectedSectionId(state, {
        payload: {
          id:
            currentSectionIndex === 0
              ? state.sections[1]?.id ?? 0
              : state.sections[currentSectionIndex - 1]?.id,
        },
      });

      const sectionsAfterDelete = state.sections.filter(
        (section) => section.id !== action.payload.id
      );
      state.sections = sectionsAfterDelete;
    },
    // later add the edit form slice and the delete form slice actions here.
    setSelectedSectionId: function (state, action) {
      if (action.payload.id === null) {
        state.selectedSectionId = null;
        sessionStorage.removeItem("selectedSectionId");
      } else {
        state.selectedSectionId = action.payload.id;
        sessionStorage.setItem("selectedSectionId", action.payload.id);
      }

      sectionSlice.caseReducers.updatePageNumber(state, {
        payload: { pageNumber: 1 },
      });
    },
    openSectionPane: (state) => {
      state.isSectionPaneOpen = true;
    },
    closeSectionPane: (state) => {
      state.isSectionPaneOpen = false;
    },
    resetToDefault: (state) => {
      state.isSectionPaneOpen = initialState.isSectionPaneOpen;
      state.sections = initialState.sections;
      state.currentPageNumber = initialState.currentPageNumber;
    },
    updatePageNumber: function (state, action) {
      state.currentPageNumber = action.payload.pageNumber;
      sessionStorage.setItem("currentPageNumber", action.payload.pageNumber);
    },
    updateTotalPages: (state, action) => {
      state.totalPages = action.payload;
      sessionStorage.setItem("totalPages", action.payload);
    },
    updateQuestionsCountInLastPage: (state, action) => {
      state.questionsCountInLastPage = action.payload;
      sessionStorage.setItem("questionsCountInLastPage", action.payload);
    },
  },
});

export const {
  setSections: setSectionsAction,
  addSection: addSectionAction,
  editSection: editSectionAction,
  deleteSection: deleteSectionAction,
  setSelectedSectionId: setSelectedSectionIdAction,
  openSectionPane: openSectionPaneAction,
  closeSectionPane: closeSectionPaneAction,
  resetToDefault: resetToDefaultAction,
  updatePageNumber: updatePageNumberAction,
  updateTotalPages: updateTotalPagesAction,
  updateQuestionsCountInLastPage: updateQuestionsCountInLastPageAction,
} = sectionSlice.actions;

export default sectionSlice.reducer;

export const selectSections = (state) => state.formSections.sections;
export const selectSelectedSectionId = (state) =>
  state.formSections.selectedSectionId;
export const selectIsSectionPaneOpen = (state) =>
  state.formSections.isSectionPaneOpen;
export const selectShouldShowLeftPane = (state) => state.formSections.sections;
export const selectPageNumber = (state) => state.formSections.currentPageNumber;
export const selectTotalPages = (state) => state.formSections.totalPages;
export const selectQuestionCountInLastPage = (state) =>
  state.formSections.questionsCountInLastPage;
