import { get } from 'lodash'
import React, { ReactHTML, ReactHTMLElement } from 'react'

interface FormInputProps {
    id: string
    type?: string
    placeholder?: string
    setOnChange?: (e: React.ChangeEvent<HTMLInputElement>) => void
}

export const FormInput = (props: FormInputProps) => {

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const onChangeValue = props.setOnChange

        if (onChangeValue instanceof Function) return onChangeValue(e)
    }
    return (
        <input 
            id={get(props, 'id')}
            type={get(props, 'type', 'text')}
            placeholder={props.placeholder} 
            onChange={(e) => handleChange(e)}
            className="block w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm" 
        />
    )
}

