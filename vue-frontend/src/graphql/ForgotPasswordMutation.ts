import gql from 'graphql-tag'

const ForgotPasswordMutation = gql`
    mutation ForgotPasswordMutation (
            $email: String!
        ){
        forgotPassword (
            email: $email
        ){
            success
            message
        }
    }
`
export default ForgotPasswordMutation
