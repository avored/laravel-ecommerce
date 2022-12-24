import React from 'react'
import { CardContent } from './CardContent'
import { CardTitle } from './CardTitle'

interface CardProps {
    children: React.ReactNode
}
export const Card = (props: CardProps) => {
  return (
    <>
        <div className="border rounded">
            {props.children}
        </div>
    </>
  )
}
