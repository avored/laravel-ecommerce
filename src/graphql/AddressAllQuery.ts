import gql from 'graphql-tag'

const AddressAllQuery = gql`
    query AddressAllQuery {
        allAddress {
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
                created_at
                updated_at
        }
    }
`
export default AddressAllQuery
