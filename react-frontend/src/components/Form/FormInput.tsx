import { get } from 'lodash'
import React, { ReactHTML, ReactHTMLElement } from 'react'

interface FormInputProps {
    id: string
    type?: string
    autofocus?: boolean
    placeholder?: string
    disabled? : boolean
    value: string|number
    errorMessages?: Array<string>
    setOnChange?: (e: React.ChangeEvent<HTMLInputElement>) => void
}

export const FormInput = (props: FormInputProps) => {

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const onChangeValue = props.setOnChange

        if (onChangeValue instanceof Function) return onChangeValue(e)
    }
    return (
        <>
            <input 
                id={get(props, 'id')}
                type={get(props, 'type', 'text')}
                placeholder={props.placeholder} 
                value={props.value}
                autoFocus={props.autofocus}
                disabled={props.disabled}
                // {(props.disabled === true) ?? disabled}
                onChange={(e) => handleChange(e)}
                className="block w-full rounded border shadow-sm border-gray-300 px-3 py-2 text-gray-900 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:opacity-70" 
            />

            {(props.errorMessages && props.errorMessages.length > 0) ? 
                props.errorMessages.map((errorMessage) => {
                <span key={errorMessage} className='text-sm mt-1 text-red-500'>
                    {errorMessage}
                </span>
                } )
                :
                ''
            }
        </>
    )
}

