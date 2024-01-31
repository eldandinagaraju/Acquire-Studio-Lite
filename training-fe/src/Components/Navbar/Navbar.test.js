import { fireEvent, render, screen, waitFor } from "@testing-library/react";
import { Provider } from "react-redux";
import { BrowserRouter } from "react-router-dom";
import store from "../../store";
import Navbar from "./Navbar";
import { loginAction } from "../../Slice/UserSlice";

const MockNavbar = () => {
    return(
        <BrowserRouter>
            <Provider store={store}>
                <Navbar />
            </Provider>
        </BrowserRouter>
    )
};

const APP_URL = process.env.REACT_APP_URL;

describe("Navbar component", () => {
    store.dispatch(loginAction({ token: "token", name: "user@gmail.com" }));

    test("on clicking logo or title it should navigate to /forms", async () => {
        render(<MockNavbar />);
        fireEvent.click(screen.getByTestId("logoAndTitle"));
        // Wait for the navigation to complete
        await waitFor(() => {
            expect(window.location.href).toBe(APP_URL+"forms");
        });
    });

    test("on clicking user icon, username, dashboard and logout option should be displayed", () => {
        render(<MockNavbar />);
        fireEvent.click(screen.getByRole("button", { name: /user/i }));
        expect(screen.getByText("user@gmail.com")).toBeTruthy();
        expect(screen.getByRole("button", { name: /dashboard/i })).toBeTruthy();
        expect(screen.getByRole("button", { name: /logout/i }));
    });

    test("on clicking dashboard it should navigate to /forms", async () => {
        render(<MockNavbar />);
        fireEvent.click(screen.getByRole("button", { name: /user/i }));
        fireEvent.click(screen.getByRole("button", { name: /dashboard/i }));
        // Wait for the navigation to complete
        await waitFor(() => {
            expect(window.location.href).toBe(APP_URL+"forms");
        });
    });

    test("on clicking login button, user should be navigate to /login", async () => {
        render(<MockNavbar />);
        fireEvent.click(screen.getByRole("button", { name: /user/i }));
        fireEvent.click(screen.getByRole("button", { name: /logout/i }));
        // Wait for the navigation to complete
        await waitFor(() => {
            expect(window.location.href).toBe(APP_URL+"login");
        });
    });
});