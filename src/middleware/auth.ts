import { AUTH_TOKEN } from '../constants/index'
import isNil from 'lodash/isNil'

export default function(): boolean {
    const accessToken = localStorage.getItem(AUTH_TOKEN)
    
    return !isNil(accessToken)
}