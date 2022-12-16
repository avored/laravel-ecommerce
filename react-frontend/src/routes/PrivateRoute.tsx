import React from "react";
import { Navigate, Outlet } from "react-router-dom";

export const PrivateRoute = () => {
  // @todo change this and check the localstorage for auth token
  const auth: boolean = true;
  return auth ? <Outlet /> : <Navigate to="/login" />;
};
