import gql from 'graphql-tag'

const UpdateAddressMutation = gql`
    mutation UpdateAddressMutation (
        $id: String!
        $type : String!
        $first_name: String!
        $last_name: String!
        $company_name: String
        $address1: String!
        $address2: String!
        $phone: String
        $city: String!
        $state: String!
        $postcode: String!
        $country_id: String!
    ) {
        updateAddress (
            id: $id
            type: $type
            first_name:$first_name
            last_name: $last_name
            company_name: $company_name
            address1: $address1
            phone: $phone
            address2: $address2
            postcode: $postcode
            city: $city
            state: $state
            country_id: $country_id
        ) {

            id
            customer_id
            type
        }
    }
`
export default UpdateAddressMutation
