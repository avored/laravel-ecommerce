import gql from 'graphql-tag'

const ResetPasswordMutation = gql`
    mutation ResetPassword(
        $token: String!
        $email: String!
        $password: String!
        $password_confirmation: String!
    ) {
        resetPassword(
            token: $token
            email: $email
            password: $password
            password_confirmation: $password_confirmation
        ) {
            success
            message
        }
    }
`
export default ResetPasswordMutation
