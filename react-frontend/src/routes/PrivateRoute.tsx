import React from "react";
import { Navigate, Outlet } from "react-router-dom";

export const PrivateRoute = () => {
  const auth: boolean = true;
  return auth ? <Outlet /> : <Navigate to="/login" />;
};
