import { useState } from 'react';
import './App.css';
import { Routes, Route } from "react-router-dom"
import Home from "./components/home"
import About from "./components/about"


export default function App() {

  return (
    <div className="container mx-auto">
      <div className="flex justify-center h-screen items-center">
        <Routes>
          <Route path="/" element={ <Home/> } />
          <Route path="about" element={ <About/> } />
        </Routes>
      </div>
    </div>
  )
}
