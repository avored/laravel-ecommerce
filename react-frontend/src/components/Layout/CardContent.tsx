import React from 'react'



interface CardContentProps {
    children: React.ReactNode
}

export const CardContent = (props: CardContentProps) => {
  return (
    <div className='p-3'>
        {props.children}
    </div>
  )
}
