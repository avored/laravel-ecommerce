import gql from 'graphql-tag'

const CreateAddress = gql`
    mutation CreateSubscriberMutation (
        $email: String!
    ) {
        CreateSubscriberMutation (
            email: $email
        ) {

            id
            customer_id
            email
            status
            created_at
            updated_at
        }
    }
`
export default CreateAddress
