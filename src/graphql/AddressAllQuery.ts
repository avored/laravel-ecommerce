import gql from 'graphql-tag'

const AddressAllQuery = gql`
    query AddressAllQuery {
        allAddress {
                id
                created_at
                updated_at
        }
    }
`
export default AddressAllQuery
