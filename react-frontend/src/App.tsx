import React from "react";
import "./App.css";
import { Routes, Route } from "react-router-dom";

import { Index } from "./pages/Index";
import { Product } from "./pages/Product";
import { LoginPage } from "./pages/auth/LoginPage";
import { Dashboard } from "./pages/user/Dashboard";
import { PrivateRoute } from "./routes/PrivateRoute";
import { CategoryShow } from "./pages/category/CategoryShow";

function App() {
  return (
    <>
      <Routes>
        <Route path="/" element={<Index />} />
        <Route path="/product" element={<Product />} />
        <Route path="/category/:slug" element={<CategoryShow />} />

        {/* ***********  User Navigation Routes or Protected routes ************  */}
        <Route path="/user" element={<PrivateRoute />}>
          <Route path="" element={<Dashboard />} />
        </Route>

        <Route path="/login" element={<LoginPage />} />
      </Routes>
    </>
  );
}

export default App;
