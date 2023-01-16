import { isEmpty } from 'lodash'
import React from 'react'


interface DebugGraphqlErrorMessageProps {
    message: string
}


export const DebugGraphqlErrorMessage = (props: DebugGraphqlErrorMessageProps) => {
    return(
        <>
            {(!isEmpty(props.message)) ? 
                (
                    <div className="">
                        <div className="bg-red-100 text-sm py-3 px-5 rounded text-red-700">
                            {props.message}
                        </div>
                    </div>
                )
            : ''
            }
        </>
    )
}
