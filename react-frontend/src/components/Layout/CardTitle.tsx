import React from 'react'

interface CardTitleProps {
  children: React.ReactNode
}


export const CardTitle = (props: CardTitleProps) => {
  return (
    <div className="p-3 border-b">
        <div className='flex w-full'>
            {props.children}
        </div>
    </div>
  )
}
