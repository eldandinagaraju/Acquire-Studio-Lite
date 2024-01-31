import { rest } from "msw";
import { userSuccessfulLogin, userUnsuccessfulLogin } from "./MockData/Login.mock";
import { addNewVersionSuccess, createFormFailure, createFormSuccess, formDetails } from "./MockData/Formslist.mock";

const API_URL = process.env.REACT_APP_API_URL;

export const handlers = [
  rest.post(API_URL+"/login", async (req, res, ctx) => {
    const { email, password } = await req.json();
    if(email === "user@gmail.com") {
      return res(ctx.json(userSuccessfulLogin));
    } else {
      return res(ctx.status(400), ctx.json(userUnsuccessfulLogin));
    }
  }),

  rest.get(API_URL+"/forms", (req, res, ctx) => {
    return res(ctx.json(formDetails));
  }),

  rest.post(API_URL+"/forms", async (req, res, ctx) => {
    const { title } = await req.json();
    if(title === "valid-title") {
      return res(ctx.json(createFormSuccess));
    } else {
      return res(ctx.status(400), ctx.json(createFormFailure));
    }
  }),

  rest.post(API_URL+"/version", async (req, res, ctx) => {
    return res(ctx.json(addNewVersionSuccess));
  }),
];
