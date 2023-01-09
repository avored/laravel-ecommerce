import React from "react";
import { Navigate, Outlet } from "react-router-dom";
import { useAppSelector } from "../app/hooks";
import { isAuth } from "../features/userLogin/userLoginSlice";

export const PrivateRoute = () => {
  // @todo change this and check the localstorage for auth token
  const auth: boolean = useAppSelector(isAuth);
  return auth ? <Outlet /> : <Navigate to="/login" />;
};
