import { Routes, Route, Navigate } from "react-router-dom";
import { lazy, Suspense } from "react";
import Protected from "./Protected";
import { useSelector } from "react-redux";
import { selectIsLoggedIn } from "../Slice/UserSlice";
import { LinearProgress } from "@material-ui/core";
import Counter from "../Pages/counter/Counter";

const FormsListingPage = lazy(() =>
  import("../Pages/FormslistingPage/Formslist")
);
const LoginPage = lazy(() => import("../Pages/LoginPage/LoginPage"));
const QuestionsPage = lazy(() => import("../Pages/QuestionPage/Questions"));
const NotFoundPage = lazy(() => import("../Pages/NotFoundPage/NotFound"));

const RoutesComponent = () => {
  const isUserLoggedIn = useSelector(selectIsLoggedIn);
  return (
    <Suspense fallback={<LinearProgress />}>
      <Routes>
        <Route
          path="/"
          element={
            isUserLoggedIn ? (
              <Navigate to={"/forms"} />
            ) : (
              <Navigate to={"/login"} />
            )
          }
        />
        <Route
          path="/login"
          element={isUserLoggedIn ? <Navigate to={"/forms"} /> : <LoginPage />}
        />
        <Route element={<Protected />}>
          <Route path="/forms" element={<FormsListingPage />} />
          <Route
            path="/forms/:formId/versions/:versionId"
            element={<QuestionsPage />}
          />
        </Route>
        <Route element={<NotFoundPage />} path="*" />
        <Route element={<Counter />} path="/counter" />
      </Routes>
    </Suspense>
  );
};

export default RoutesComponent;
