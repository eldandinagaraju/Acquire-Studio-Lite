import { render, screen, logRoles, fireEvent } from "@testing-library/react";
import "@testing-library/jest-dom";
import NotFoundPage from "./NotFound";
import { BrowserRouter } from "react-router-dom";
import { Provider } from "react-redux";
import store from "../../store";

const MockNotFound = () => {
  return (
    <BrowserRouter>
      <Provider store={store}>
        <NotFoundPage />
      </Provider>
    </BrowserRouter>
  );
};

describe("Not found page", () => {
  test("consists the oops element", () => {
    render(<MockNotFound />);

    const oopsElement = screen.getByRole("heading", {
      level: 3,
    });

    expect(oopsElement).toBeInTheDocument();
  });

  test("consists of we are sorry element", () => {
    render(<MockNotFound />);
    const sorryElement = screen.getByRole("heading", {
      level: 2,
    });

    expect(sorryElement).toBeInTheDocument();
  });

  test("multiple elements length check", () => {
    render(<MockNotFound />);
    const groupElement = screen.getAllByText("4");

    expect(groupElement).toHaveLength(2);
  });

  test("0 exists in the document", () => {
    render(<MockNotFound />);
    const zeroElement = screen.getByText("0");

    expect(zeroElement).toBeInTheDocument();
  });

  test("clicked go back to home button", () => {
    render(<MockNotFound />);

    const goBackBtn = screen.getByRole("button");

    fireEvent.click(goBackBtn);
  });
});
