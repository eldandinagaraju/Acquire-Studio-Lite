import { fireEvent, render, screen, waitFor } from "@testing-library/react";
import SectionsPane from "./SectionsPane";
import { Provider } from "react-redux";
import store from "../../../store";
import { sectionsData } from "../../../MockServer/MockData/SectionsPane";
import { setSectionsAction, setSelectedSectionIdAction } from "../../../Slice/SectionSlice";
import { ThemeProvider } from "@mui/material";
import { lightTheme } from "../../../Constants";

const MockSectionsPane = () => {
    return(
        <Provider store={store}>
            <ThemeProvider theme={lightTheme}>
                <SectionsPane />
            </ThemeProvider>
        </Provider>
    )
}

describe("Sections component", () => {
    test("if an error occurs while getting sections, empty component is displayed", () => {
        store.dispatch(setSectionsAction({ sections: [] }));
        render(<MockSectionsPane />);
        expect(screen.queryByTestId("sections")).not.toBeTruthy();
    });

    test("after successfully getting sections, they are displayed", () => {
        store.dispatch(setSectionsAction({ sections: sectionsData }));
        render(<MockSectionsPane />);
        expect(screen.getByTestId("sections")).toBeTruthy();
    });

    test("on clicking a section, it is selected", async () => {
        store.dispatch(setSelectedSectionIdAction({ id: null }));
        render(<MockSectionsPane />);
        fireEvent.click(screen.getByTestId("section1"));
        const sectionListStyle = getComputedStyle(screen.getByTestId("section1"));
        expect(sectionListStyle.getPropertyValue("color")).toBe("rgb(0, 138, 158)");
    });

    test("on clicking the menu icon 'edit', 'delete' and 'add question' options will be displayed", () => {
        render(<MockSectionsPane />);
        fireEvent.click(screen.getByLabelText("more1"));
        expect(screen.getByTestId("basic-menu")).toBeTruthy();
    });
});