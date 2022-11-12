import { useState } from 'react';
import { Routes, Route } from "react-router-dom"
import { HomePage } from './pages/HomePage';
import { LoginPage } from './pages/auth/LoginPage';

export default function App() {

  return (
    <div className="antialiased">
        <Routes>
          <Route path="/" element={ <HomePage/> } />
          <Route path="/about" element={ <HomePage/> } />
          <Route path="login" element={ <LoginPage/> } />
        </Routes>
    </div>
  )
}
