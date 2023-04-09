import gql from 'graphql-tag'

const CustomerLoginMutation = gql`
    mutation CustomerLogin (
            $password: String!
            $email: String
        ) {
        login (
            email: $email
            password: $password
        ) {
            first_name
            last_name
            email
            image_path
            id
            created_at
            updated_at
            addresses {
                id
            }
            token_info {
                token_type
                access_token
                expires_in
                refresh_token
            }
        }
    }
`
export default CustomerLoginMutation
