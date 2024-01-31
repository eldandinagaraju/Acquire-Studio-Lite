import { fireEvent, render, screen } from "@testing-library/react";
import "@testing-library/jest-dom/extend-expect";
import Counter from "./Counter";

describe("Counter", () => {
  test("renders correctly", async () => {
    render(<Counter />);
    const counterHeading = screen.getByRole("heading");
    expect(counterHeading).toBeInTheDocument();

    const buttonElement = screen.getByRole("button", {
      name: "Increment",
    });

    expect(buttonElement).toBeInTheDocument();

    expect(counterHeading).toHaveTextContent(0);

    await fireEvent.click(buttonElement);

    expect(counterHeading).toHaveTextContent("1");
  });

  test("checks if the value changes correctly for expected inputs", () => {
    render(<Counter />);

    const headingElement = screen.getByRole("heading");

    expect(headingElement).toBeInTheDocument();

    const numberELement = screen.getByRole("spinbutton");

    expect(numberELement).toBeInTheDocument();

    fireEvent.change(numberELement, { target: { value: 20 } });

    expect(numberELement).toHaveValue(20);
  });

  test("checking all the buttons functionalities", () => {
    render(<Counter />);

    const countElement = screen.getByRole("heading");
    expect(countElement).toBeInTheDocument();

    const numberElement = screen.getByRole("spinbutton");
    expect(numberElement).toBeInTheDocument();

    const setBtn = screen.getByRole("button", {
      name: "Set",
    });

    expect(setBtn).toBeInTheDocument();

    const incrementButton = screen.getByRole("button", {
      name: "Increment",
    });

    expect(incrementButton).toBeInTheDocument();

    fireEvent.change(numberElement, { target: { value: 10 } });

    expect(numberElement).toHaveValue(10);

    fireEvent.click(incrementButton);

    expect(countElement).toHaveTextContent("1");
  });

  test("clicking on set button event triggered", () => {
    render(<Counter />);

    const headingElement = screen.getByRole("heading");

    const setButton = screen.getByRole("button", {
      name: "Set",
    });

    const numberELement = screen.getByRole("spinbutton");

    fireEvent.change(numberELement, { target: { value: 10 } });

    fireEvent.click(setButton);

    expect(headingElement).toHaveTextContent("10");
  });

  test("labl test", () => {
    render(<Counter />);
    const labelElement = screen.getByText("Options");

    expect(labelElement).toBeInTheDocument();
  });
});
