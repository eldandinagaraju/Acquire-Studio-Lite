import { screen, render, fireEvent } from "@testing-library/react";
import "@testing-library/jest-dom";

import Options from "./Options";

describe("options component", () => {
  test("consists of options", () => {
    render(
      <Options
        options={["option 1", "option 2"]}
        type="SINGLE_SELECT"
        updateOptionsHandler={jest.fn()}
      />
    );

    const option = screen.getByText("option 1");
    expect(option).toBeInTheDocument();
  });

  test("return for integer or text type", () => {
    render(
      <Options type="TEXT_TYPE" options={[]} updateOptionsHandler={jest.fn()} />
    );
  });

  const updateOptionsHandler = jest.fn();
  test("renders correctly when passing the options in edit mode with type multi select", () => {
    render(
      <Options
        options={["option 1", "option 2"]}
        isEdit={true}
        type={"MULTI_SELECT"}
        updateOptionsHandler={updateOptionsHandler}
      />
    );

    const iconButton = screen.getByRole("button", {
      name: "add new option",
    });

    expect(iconButton).toBeInTheDocument();

    fireEvent.click(iconButton);
    expect(updateOptionsHandler).toHaveBeenCalledTimes(1);
  });

  test("renders correctly while we try to delete the options", () => {
    const updateOptionsHandler = jest.fn();
    render(
      <Options
        options={["option 1", "option 2"]}
        isEdit={true}
        updateOptionsHandler={updateOptionsHandler}
        type="SINGLE_SELECT"
      />
    );

    const deleteButtons = screen.getAllByLabelText("Delete option");

    expect(deleteButtons).toHaveLength(2);
    console.log(deleteButtons);

    deleteButtons.forEach((deleteButton) => {
      fireEvent.click(deleteButton);
    });

    expect(updateOptionsHandler).toHaveBeenCalledTimes(2);
  });

  test("renders correctly while we try to change the option text", () => {
    const updateOptionsHandler = jest.fn();
    render(
      <Options
        options={["option 1", "option 2"]}
        type={"SINGLE_SELECT"}
        isEdit={true}
        updateOptionsHandler={updateOptionsHandler}
      />
    );

    const options = screen.getAllByRole("textbox");
    expect(options).toHaveLength(2);

    options.forEach((option) => {
      fireEvent.change(option, { target: { value: "changed option" } });
    });

    expect(updateOptionsHandler).toHaveBeenCalledTimes(2);
  });

  test("renders as expected while we try to update the error state", () => {
    const updateErrorState = jest.fn();
    const updateOptionsHandler = jest.fn();
    render(
      <Options
        options={["option 1", "option 2"]}
        type={"SINGLE_SELECT"}
        isEdit={true}
        optionError={["dummy error"]}
        updateErrorState={updateErrorState}
        updateOptionsHandler={updateOptionsHandler}
      />
    );

    const addBtn = screen.getByRole("button", {
      name: "add new option",
    });

    expect(addBtn).toBeInTheDocument();

    fireEvent.click(addBtn);

    const options = screen.getAllByRole("textbox");
    expect(options).toHaveLength(2);

    options.forEach((option) => {
      fireEvent.change(option, { target: { value: "changed option" } });
    });

    expect(updateErrorState).toHaveBeenCalledTimes(2);
  });

  test("error state is updated as expected while we trigger the onblur event", () => {
    const updateOptionsHandler = jest.fn();
    const updateErrorState = jest.fn();

    render(
      <Options
        options={["option 1", "option 2"]}
        type={"SINGLE_SELECT"}
        isEdit={true}
        optionError={["dummy error"]}
        updateErrorState={updateErrorState}
        updateOptionsHandler={updateOptionsHandler}
      />
    );

    const addBtn = screen.getByRole("button", {
      name: "add new option",
    });

    fireEvent.click(addBtn);

    const options = screen.getAllByRole("textbox");
    expect(options).toHaveLength(2);

    options.forEach((option) => fireEvent.blur(option));
    expect(updateErrorState).toHaveBeenCalledTimes(2);
  });
});
