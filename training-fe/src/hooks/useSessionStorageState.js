import { useEffect, useState } from "react";

export const useSessionStorageState = (key, initalState) => {
  // this is to get the state from the session storage. if the session storage state is empty then use the inital state.
  const [state, setState] = useState(
    JSON.parse(sessionStorage.getItem(key)) ?? initalState
  );
  useEffect(() => {
    // this is to update the session storage value when ever the state updates.
    sessionStorage.setItem(key, JSON.stringify(state));
  }, [state, key]);
  return [state, setState];
};
