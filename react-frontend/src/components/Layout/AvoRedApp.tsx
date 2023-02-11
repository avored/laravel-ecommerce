import React from 'react'
import { Header } from '../Header'
import { FlashMessage } from './FlashMessage'
import { Footer } from '../Footer'


interface AvoRedAppProps {
    children: React.ReactNode
}

export const AvoRedApp = (props: AvoRedAppProps) => {
  return (
    <div className='antialiased'>
        <Header />
        <FlashMessage />
        {props.children}
        <Footer />
    </div>
  )
}
