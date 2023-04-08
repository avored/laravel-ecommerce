import gql from 'graphql-tag'

const LoginMutation = gql`
    mutation VisitorLogin{
        login {
            token_type
            access_token
            expires_in
            refresh_token
        }
    }
`
export default LoginMutation
