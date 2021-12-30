import { AUTH_TOKEN } from '../constants/index'
import isNil from 'lodash/isNil'
import { useMutation, gql } from "@urql/vue"
import { NoUndefinedVariablesRule } from 'graphql'

const TOKEN_IN_PROGRESS = 'token_in_progress'

const isAuth = () : boolean => {
    const accessToken = localStorage.getItem(AUTH_TOKEN)
    return (!isNil(accessToken) || true)
}
const getToken = async () => {
    const tokenInProgress = localStorage.getItem(TOKEN_IN_PROGRESS)
    localStorage.setItem(TOKEN_IN_PROGRESS, 'true')
    
    // const token = localStorage.getItem('access_token')
    if (tokenInProgress === null) {
        const loginMutation = gql `mutation {
                                login {
                                    token_type
                                    access_token
                                    expires_in
                                    refresh_token
                                }
                            }`
        const loginMutationRef = useMutation(loginMutation)
        const myTestToken = await loginMutationRef.executeMutation({}).then((result) => {
            // console.log('auth', result)

            return result.data.login.access_token
        })

        console.log(myTestToken)
        localStorage.setItem('access_token', myTestToken)
        // return myTestToken
        // const result = await loginMutationRef.executeMutation({})
        // localStorage.removeItem(TOKEN_IN_PROGRESS)
    }
// 
    // console.log(process.env.VUE_APP_ACCESS_TOKEN)
    //@todo fix this later on 
    // return process.env.VUE_APP_ACCESS_TOKEN
}

export default {
    isAuth,
    getToken
}
