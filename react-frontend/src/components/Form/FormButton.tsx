import React from 'react'
import { Link } from 'react-router-dom'


interface FormButtonProps {
    children: React.ReactNode
    type: "button" | "submit" | 'reset'
}

export const FormButton = (props: FormButtonProps) => {

    return (
        <button
            type={props.type ?? 'button'}
            className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 focus:ring-offset-1"
        >
            {props.children}
        </button>
    )
}
