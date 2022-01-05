import gql from 'graphql-tag'

const GetCustomerQuery = gql`
    query GetCustomer{
        customerQuery {
                id
                first_name
                last_name
                email
                created_at
                updated_at
        }
    }
`
export default GetCustomerQuery
