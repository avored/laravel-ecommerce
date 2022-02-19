import gql from 'graphql-tag'

const CustomerLoginMutation = gql`
    mutation CustomerLogin (
            $password: String!
            $email: String!
        ) {
        login (
            email: $email
            password: $password
        ) {
            token_type
            access_token
            expires_in
            refresh_token
        }
    }
`
export default CustomerLoginMutation
