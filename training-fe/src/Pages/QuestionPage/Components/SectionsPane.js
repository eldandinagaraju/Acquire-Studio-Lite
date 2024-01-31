import {
  Divider,
  List,
  ListItem,
  ListItemButton,
  Typography,
} from "@mui/material";
import { useDispatch, useSelector } from "react-redux";

import {
  closeSectionPaneAction,
  selectSections,
  selectSelectedSectionId,
  setSelectedSectionIdAction,
} from "../../../Slice/SectionSlice";

import EditIcon from "@mui/icons-material/Edit";
import DeleteIcon from "@mui/icons-material/Delete";
import AddIcon from "@mui/icons-material/Add";
import EmptyComponent from "../../EmptyPage/EmptyComponent";

import { CustomMenu } from "../../../Components/Menu";
import OverflowWrapper from "../../../Components/OverflowWrapper";
import { SECTION_LOADING_KEY } from "../Questions.Constants";
import { loadingState } from "../../../Slice/LoadingSlice";
import React from "react";

function SectionsPane({
  addQuestionHandler,
  editSectionHandler,
  deleteSectionHandler,
}) {
  const sections = useSelector(selectSections);
  const isSectionsLoading = useSelector(loadingState(SECTION_LOADING_KEY));

  const dispatch = useDispatch();

  const handleSectionSelection = (id) => {
    dispatch(setSelectedSectionIdAction({ id }));
    dispatch(closeSectionPaneAction());
  };

  const selectedSectionId = useSelector(selectSelectedSectionId);

  const getSectionMenuObj = (id) => [
    {
      title: "Edit",
      icon: <EditIcon fontSize="small" color="primary" />,
      handler: editSectionHandler,
    },
    {
      title: "Delete",
      icon: <DeleteIcon fontSize="small" color="error" />,
      handler: deleteSectionHandler,
    },
    {
      title: "Add Question",
      icon: <AddIcon fontSize="small" color="success" />,
      handler: addQuestionHandler,
    },
  ];

  return sections?.length === 0 ? (
    <EmptyComponent message="sections" isLoading={isSectionsLoading} />
  ) : (
    <List data-testid="sections">
      <Divider />
      {sections?.map((section) => (
        <React.Fragment key={section.id}>
          <ListItem
            sx={{
              ...(selectedSectionId === section.id && {
                color: "primary.main",
              }),
            }}
            disablePadding
            onClick={() => {
              if (selectedSectionId !== section.id)
                handleSectionSelection(section.id);
            }}
            data-testid={`section${section.id}`}
          >
            <ListItemButton>
              <OverflowWrapper
                element={<Typography>{section.title}</Typography>}
                sx={{ width: "100%" }}
              />
            </ListItemButton>
            <CustomMenu menuObj={getSectionMenuObj(section.id)} horizontal id={section.id} />
          </ListItem>
          <Divider />
        </React.Fragment>
      ))}
    </List>
  );
}

export default SectionsPane;
