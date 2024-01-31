import { Provider } from "react-redux"
import { BrowserRouter } from "react-router-dom"
import Formlist from "./Formslist"
import store from "../../store"
import { fireEvent, render, screen, waitFor } from "@testing-library/react"
import { server } from "../../MockServer/server"
import { rest } from "msw"
import { deleteFormSuccess, formsError, updateFormFailure, updateFormSuccess } from "../../MockServer/MockData/Formslist.mock"
import Snackbar from "../../Components/AlertSnackbar";
import { FORM_CREATE_SUCCESS_MESSAGE, FORM_DELETE_FAILURE_MESSAGE, NO_FORM_VERSIONS_MESSAGE, VERSION_CREATE_SUCCESS_MESSAGE, VERSION_CREATION_FAILED_MESSAGE } from "./Formslist.Constants"

const MockFormslist = () => {
    return(
        <BrowserRouter>
            <Provider store={store}>
                <Snackbar />
                <Formlist />
            </Provider>
        </BrowserRouter>
    )
}

const API_URL = process.env.REACT_APP_API_URL;
const APP_URL = process.env.REACT_APP_URL;

describe("Formslist component", () => {
    beforeAll(() => server.listen());
    afterEach(() => server.resetHandlers());
    afterAll(() => server.close());

    test("on successful get of forms from backend, forms should be displayed", async () => {
        render(<MockFormslist />);
        await waitFor(() => {
            expect(screen.getByTestId("forms")).toBeTruthy();
        });
    });

    test("if an error occured while getting forms, empty component should be displayed", async () => {
        server.use(
            rest.get(API_URL+"/forms", (req, res, ctx) => {
                return res(ctx.status(401), ctx.json(formsError));
            })
        )
        render(<MockFormslist />);
        await waitFor(() => {
            expect(screen.getByText("No forms to display")).toBeTruthy();
        });
    });

    test("by giving input in search field, particular forms can be displayed", async () => {
        render(<MockFormslist />);
        await waitFor(() => {
            //the forms which contains the search input in its title will be displayed
            fireEvent.change(screen.getByLabelText("Search"), { target: { value: "form" }});
            expect(screen.getByTestId("forms")).toBeTruthy();
            //if search input is not present in any forms title, empty component will be displayed
            fireEvent.change(screen.getByLabelText("Search"), { target: { value: "Acquire" }});
            expect(screen.queryByTestId("forms")).not.toBeTruthy();
            fireEvent.change(screen.getByLabelText("Search"), { target: { value: "" }});
        });
    });

    test("when a form is clicked, the versions of that form should be displayed", async () => {
        render(<MockFormslist />);
        await waitFor(async () => {
            fireEvent.click(screen.getByTestId("form1"));
            expect(screen.getByText("Versions")).toBeTruthy();
            //on clicking close icon, versions should not be displayed
            fireEvent.click(screen.getByTestId("versions-close"));
            expect(screen.queryByText("Versions")).not.toBeTruthy();
            //if a form with no versions is clicked, no versions should be displayed
            fireEvent.click(screen.getByTestId("form3"));
            await waitFor(() => {
                expect(screen.getByText(NO_FORM_VERSIONS_MESSAGE)).toBeTruthy();
                expect(screen.queryByText("Versions")).not.toBeTruthy();
            });
        });
    });

    test("on clicking menu icon of any form, the edit, delete and add new version options should be shown", async () => {
        render(<MockFormslist />);
        await waitFor(async () => {
            fireEvent.click(screen.getByLabelText("more1"));
            expect(screen.getByTestId("basic-menu")).toBeTruthy();
        });
    });

    test("after clicking 'add new form' button and giving valid form title, form should be created", async () => {
        render(<MockFormslist />);
        fireEvent.click(screen.getByRole("button", { name: /add new form/i }));
        fireEvent.change(screen.getByLabelText("Form title"), { target: { value: "valid-title" }});
        fireEvent.click(screen.getByRole("button", { name: /create/i }));
        await waitFor(() => {
            expect(screen.getByText(FORM_CREATE_SUCCESS_MESSAGE)).toBeTruthy();
        });
    });

    test("after clicking 'add new form' button and giving invalid form title, form should not be created", async () => {
        //if invalid title is given, form is not created
        render(<MockFormslist />);
        fireEvent.click(screen.getByRole("button", { name: /add new form/i }));
        fireEvent.change(screen.getByLabelText("Form title"), { target: { value: "invalid-title" }});
        console.log(screen.getByLabelText("Form title").value);
        fireEvent.click(screen.getByRole("button", { name: /create/i }));
        await waitFor(() => {
            expect(screen.getByText("Form title already exists")).toBeTruthy();
        });
    });

    test("after clicking 'edit' menu option and giving valid form title, form should be updated", async () => {
        server.use(
            rest.patch(API_URL+"/forms/1", async (req, res, ctx) => {
                return res(ctx.json(updateFormSuccess));
            }),
        )
        render(<MockFormslist />);
        await waitFor(async () => {
            fireEvent.click(screen.getByLabelText("more1"));
            fireEvent.click(screen.getByTestId("Edit"));
            expect(screen.getByText("Update Form")).toBeTruthy();
            fireEvent.change(screen.getByLabelText("Form title"), { target: { value: "valid-title" } });
            fireEvent.click(screen.getByRole("button", { name: /update/i }));
            expect(screen.getByText("Form updated successfully")).toBeTruthy();
        });
    });

    test("after clicking 'edit' menu option and giving invalid form title, form should not be updated", async () => {
        //if invalid form title is given
        server.use(
            rest.patch(API_URL+"/forms/1", async (req, res, ctx) => {
                return res(ctx.status(400), ctx.json(updateFormFailure));
            }),
        )
        render(<MockFormslist />);
        await waitFor(async () => {
            fireEvent.click(screen.getByLabelText("more1"));
            fireEvent.click(screen.getByTestId("Edit"));
            expect(screen.getByText("Update Form")).toBeTruthy();
            fireEvent.change(screen.getByLabelText("Form title"), { target: { value: "invalid-title" } });
            fireEvent.click(screen.getByRole("button", { name: /update/i }));
            expect(screen.getByText("Form title already exists")).toBeTruthy();
        });
    });

    test("after clicking 'delete' menu option, a confirmation dialog box pops up and form will be deleted upon clicking delete button", async () => {
        server.use(
            rest.delete(API_URL+"/forms/1", async (req, res, ctx) => {
                return res(ctx.json(deleteFormSuccess));
            }),
        )
        render(<MockFormslist />);
        await waitFor(async () => {
            // expect(screen.getByTestId("forms")).toBeTruthy();
            fireEvent.click(screen.getByLabelText("more1"));
            fireEvent.click(screen.getByTestId("Delete"));
            expect(screen.getByText("Delete Form")).toBeTruthy();
            fireEvent.click(screen.getByRole("button", { name: /delete/i }));
            await waitFor(() => {
                expect(screen.getByText("Form deleted successfully")).toBeTruthy();
                // form is deleted, so it should not be present
                expect(screen.queryByTestId("form1")).not.toBeTruthy();
            });
        });
    });

    test("after clicking 'delete' menu option, a confirmation dialog box pops up and upon clicking cancel button it closes", async () => {
        render(<MockFormslist />);
        await screen.findByLabelText("more1");
        fireEvent.click(screen.getByLabelText("more1"));
        fireEvent.click(screen.getByTestId("Delete"));
        expect(screen.getByText("Delete Form")).toBeTruthy();
        fireEvent.click(screen.getByRole("button", { name: /cancel/i }));
        await waitFor(() => {
            //cancel is clicked, form is not deleted so it should be present
            expect(screen.getByTestId("form1")).toBeTruthy();
            expect(screen.queryByText("Delete Form")).not.toBeTruthy();
        });
    });

    test("after clicking 'delete' menu option, if any error occurs the form will not be deleted", async () => {
        server.use(
            rest.delete(API_URL+"/forms/1", async (req, res, ctx) => {
                return res(ctx.status(400));
            }),
        )
        render(<MockFormslist />);
        await waitFor(async () => {
            fireEvent.click(screen.getByLabelText("more1"));
            fireEvent.click(screen.getByTestId("Delete"));
            expect(screen.getByText("Delete Form")).toBeTruthy();
            fireEvent.click(screen.getByRole("button", { name: /delete/i }));
            expect(screen.getByText(FORM_DELETE_FAILURE_MESSAGE)).toBeTruthy();
            expect(screen.getByTestId("form1")).toBeTruthy();
        });
    });

    test("after clicking cancel button in dialog box, the respective dialog box should be closed", async () => {
        //if cancel button is clicked, the create dialog box should be closed
        render(<MockFormslist />);
        fireEvent.click(screen.getByRole("button", { name: /add new form/i }));
        expect(screen.getByText("Create Form")).toBeTruthy();
        fireEvent.click(screen.getByRole("button", { name: /cancel/i }));
        await waitFor(() => {
            expect(screen.queryByText("Create Form")).not.toBeTruthy();
        });

        //if cancel button is clicked, the update dialog box should be closed
        render(<MockFormslist />);
        fireEvent.click(screen.getByLabelText("more1"));
        fireEvent.click(screen.getByTestId("Edit"));
        expect(screen.getByText("Update Form")).toBeTruthy();
        fireEvent.click(screen.getByRole("button", { name: /cancel/i }));
        await waitFor(() => {
            expect(screen.queryByText("Update Form")).not.toBeTruthy();
        });
    });

    test("after clicking 'add new version' menu option, a new version will be created for that form", async () => {
        render(<MockFormslist />);
        await waitFor(async () => {
            fireEvent.click(screen.getByLabelText("more1"));
            fireEvent.click(screen.getByTestId("Add New Version"));
            await waitFor(() => {
                expect(screen.getByText(VERSION_CREATE_SUCCESS_MESSAGE)).toBeTruthy();
            });
        });
    });

    test("after clicking 'add new version' menu option, if any error occurs a new version will not be created for that form", async () => {
        server.use(
            rest.post(API_URL+"/version", async (req, res, ctx) => {
                return res(ctx.status(400));
            }),
        )
        render(<MockFormslist />);
        await waitFor(async () => {
            fireEvent.click(screen.getByLabelText("more1"));
            fireEvent.click(screen.getByTestId("Add New Version"));
            fireEvent.click(screen.getByTestId("form1"));
            await waitFor(() => {
                expect(screen.getByText(VERSION_CREATION_FAILED_MESSAGE)).toBeTruthy();
            });
        });
    });

    test("on clicking a version, user should be navigated to ${formId}/versions/${v.versionID}", async () => {
        render(<MockFormslist />);
        await waitFor(async () => {
            fireEvent.click(screen.getByTestId("form1"));
            expect(screen.getByText("Versions")).toBeTruthy();
            fireEvent.click(screen.getByTestId("version1"));
            // Wait for the navigation to complete
            await waitFor(() => {
                expect(window.location.href).toBe(APP_URL+"1/versions/1");
            });
        });
    });
});