import { fireEvent, render, screen, waitFor } from "@testing-library/react";
import LoginPage from "./LoginPage";
import { BrowserRouter } from "react-router-dom";
import { Provider } from "react-redux";
import store from "../../store";
import { server } from "../../MockServer/server";

const MockLogin = () => {
  return (
    <BrowserRouter>
      <Provider store={store}>
        <LoginPage />
      </Provider>
    </BrowserRouter>
  );
};

const APP_URL = process.env.REACT_APP_URL;

describe("LoginPage component", () => {
  beforeAll(() => server.listen());
  afterEach(() => server.resetHandlers());
  afterAll(() => server.close());

  test("an error should be displayed when the username entered is not in the correct format", () => {
    render(<MockLogin />);
    const usernameTextField = screen.getByLabelText("Username *");
    fireEvent.change(usernameTextField, { target: { value: "user" } });
    expect(usernameTextField.value).toBeTruthy();
    expect(screen.getByText("Invalid Email")).toBeTruthy();
  });

  test("input password should be visible when password-visibility icon is clicked and hidden when password-visibilityOff icon is clicked", () => {
    render(<MockLogin />);
    const passwordTextField = screen.getByLabelText("Password *");
    fireEvent.mouseDown(
      screen.getByRole("button", { name: /toggle password visibility/i })
    );
    expect(passwordTextField.getAttribute("type")).toBe("text");
    fireEvent.click(
      screen.getByRole("button", { name: /toggle password visibility/i })
    );
    expect(passwordTextField.getAttribute("type")).toBe("password");
  });

  test("upon unsuccessful login, error message should be displayed", async () => {
    render(<MockLogin />);
    const usernameTextField = screen.getByLabelText("Username *");
    const passwordTextField = screen.getByLabelText("Password *");
    fireEvent.change(usernameTextField, {
      target: { value: "invalid-Username@gmail.com" },
    });
    fireEvent.change(passwordTextField, {
      target: { value: "invalid-Password" },
    });
    expect(usernameTextField.value).toBeTruthy();
    expect(passwordTextField.value).toBeTruthy();
    fireEvent.click(screen.getByRole("button", { name: /login/i }));
    // Wait for the navigation to complete
    await waitFor(() => {
      expect(window.location.href).toBe(APP_URL);
      expect(screen.getByRole("alert")).toBeTruthy();
    });
  });

  test("upon successful login, user should be navigated to /forms", async () => {
    server.resetHandlers();
    render(<MockLogin />);
    const usernameTextField = screen.getByLabelText("Username *");
    const passwordTextField = screen.getByLabelText("Password *");
    fireEvent.change(usernameTextField, {
      target: { value: "user@gmail.com" },
    });
    fireEvent.change(passwordTextField, { target: { value: "Password@1" } });
    expect(usernameTextField.value).toBeTruthy();
    expect(passwordTextField.value).toBeTruthy();
    fireEvent.click(screen.getByRole("button", { name: /login/i }));
    // Wait for the navigation to complete
    await waitFor(() => {
      expect(window.location.href).toBe(APP_URL + "forms");
    });
  });
});
