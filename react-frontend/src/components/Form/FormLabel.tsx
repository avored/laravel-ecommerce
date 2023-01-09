import { get } from 'lodash'
import React from 'react'

interface FormLabelProps {
    forId: string
    labelText: string
}
export const FormLabel = (props: FormLabelProps) => {
  return (
    <label htmlFor={get(props, 'forId')} className='text-gray-600 pl-1 text-sm'>
        {props.labelText}
    </label>
  )
}

