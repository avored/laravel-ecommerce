import React from 'react'
import { Link } from 'react-router-dom'


interface FormLinkProps {
    children: React.ReactNode
    path: string
}

export const FormLink = (props: FormLinkProps) => {

    return (
        <Link
            to={props.path}
            className="font-medium text-red-600 hover:text-red-500 focus:outline-none focus:rounded-sm focus:border-none focus:ring-1 focus:ring-red-500 focus:ring-offset-2"
        >
            {props.children}
        </Link>
    )
}
