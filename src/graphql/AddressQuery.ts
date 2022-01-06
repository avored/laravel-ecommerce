

import gql from 'graphql-tag'

const AddressQuery = gql`
    query AddressQuery (
        $addressId : String!
    ){
        addressQuery(
            id: $addressId 
        ) {
            id
            type
            first_name
            last_name
            company_name
            phone
            address1
            address2
            state
            city
            postcode
            country_id
            created_at
            updated_at
        }
    }

`
export default AddressQuery
