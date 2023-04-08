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
            addresses {
                id
                type
                first_name
                last_name
                company_name
                phone
                address1
                address2
                city
                state
                postcode
                country_id
                country_name
                created_at
                updated_at
            }
        }
    }
`
export default GetCustomerQuery
