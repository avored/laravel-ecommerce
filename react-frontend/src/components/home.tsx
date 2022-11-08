import React from 'react';
import  { Link } from 'react-router-dom'

export default function Home() {
  return (
    <div className="container mx-auto">
      <div className="flex justify-center h-screen items-center">
        <h1 className="text-xl font-bold ">
          AvoRed React E commerce Home
          <Link to="about">Click to view our about page</Link>
        </h1>
      </div>
    </div>
  )
}
