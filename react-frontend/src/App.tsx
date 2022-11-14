import React from 'react';
import './App.css';
import { Routes, Route, Link } from "react-router-dom";

import { Index } from './pages/Index';
import { Product } from './pages/Product'


function App() {
  return (
    <>
        <nav>
          <ul>
            <li><Link to="/">Home</Link></li>
            <li><Link to="/product">Product</Link></li>
          </ul>
        </nav>
        <Routes>
          <Route path='/' element={<Index />} />
          <Route path='/product' element={<Product />} />
      </Routes>
    </>
  );
}

export default App;
