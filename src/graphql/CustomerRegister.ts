import gql from 'graphql-tag'

const CustomerRegister = gql`
    mutation CustomerRegistration (
        $email: String!
        $password: String!
        $first_name: String!
        $last_name: String!
    ) {
        register (
            first_name: $first_name,
            last_name: $last_name,
            email: $email,
            password: $password
        ) {
            access_token
        }
    }
`
export default CustomerRegister
