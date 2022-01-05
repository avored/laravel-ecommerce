import gql from 'graphql-tag'

const CustomerEditMutation = gql`
    mutation CustomerEditMutation(
        $first_name: String!,
        $last_name: String!,
    ) {
        customerUpdate(   
            first_name: $first_name,
            last_name: $last_name
        )  {
            first_name
            last_name
        }
    }
`
export default CustomerEditMutation
