import React from 'react';
import './App.css';
import { Routes, Route } from "react-router-dom";

import { Index } from './pages/Index';
import { Product } from './pages/Product'


function App() {
  return (
        <Routes>
          <Route path='/' element={<Index />} />
          <Route path='/product' element={<Product />} />
      </Routes>
  );
}

export default App;
