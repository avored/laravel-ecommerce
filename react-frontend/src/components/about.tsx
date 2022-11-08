import React from 'react'
import { Link } from 'react-router-dom'

export default function About() {
  return (
    <div className="container mx-auto">
      <div className="flex justify-center h-screen items-center">
        <h1 className="text-xl font-bold ">
          AvoRed React E commerce About
          <Link to="/">Click to view our home page</Link>
        </h1>
      </div>
    </div>
  )
}
