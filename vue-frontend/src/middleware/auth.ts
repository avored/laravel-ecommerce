import { AUTH_TOKEN, CUSTOMER_LOGGED_IN } from '../constants/index'
import isNil from 'lodash/isNil'

const TOKEN_IN_PROGRESS = 'token_in_progress'

const isAuth = () : boolean => {
    const accessToken = localStorage.getItem(AUTH_TOKEN)

    return !isNil(accessToken)
}
const isCustomer = (): boolean => {
    
    const customerLoggedIn = localStorage.getItem(CUSTOMER_LOGGED_IN)

    return !isNil(customerLoggedIn)
}
const getToken = () => {    
    return localStorage.getItem('access_token')
}

export default {
    isAuth,
    getToken,
    isCustomer
}
