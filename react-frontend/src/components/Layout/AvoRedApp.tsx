import React from 'react'
import { Header } from '../Header'
import { FlashMessage } from './FlashMessage'


interface AvoRedAppProps {
    children: React.ReactNode
  }

  

export const AvoRedApp = (props: AvoRedAppProps) => {
  return (
    <div className='antialiased'>
        <Header />
        <FlashMessage />
        {props.children}
    </div>
  )
}
