import { Tooltip } from "@mui/material";
import React, { useEffect, useState } from "react";
import { useRef } from "react";

function isEllipsisActive(e) {
  const element = e.current;
  if (element.clientWidth < element.scrollWidth) {
    var style = element.currentStyle || window.getComputedStyle(element);
    return style.textOverflow === "ellipsis";
  }
  return false;
}

function OverflowWrapper({ element, sx }) {
  const [shouldShowTooltip, setShouldShowToolTip] = useState(false);
  const elementRef = useRef();
  useEffect(() => {
    if (isEllipsisActive(elementRef)) setShouldShowToolTip(true);
    else {
      setShouldShowToolTip(false);
    }
  }, []);
  const modifiedElement = React.cloneElement(element, {
    ...element.props,
    ref: elementRef,
    style: {
      ...sx,
      whiteSpace: "nowrap",
      overflow: "hidden",
      textOverflow: "ellipsis",
    },
  });
  const elementTitle = element.props.children;

  return (
    <Tooltip
      title={shouldShowTooltip ? elementTitle : ""}
      arrow
      enterTouchDelay={0}
    >
      {modifiedElement}
    </Tooltip>
  );
}

export default OverflowWrapper;
