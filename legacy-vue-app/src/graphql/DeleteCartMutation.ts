import gql from 'graphql-tag'

const DeleteCartMutation = gql`
    mutation DeleteCartMutation (
        $slug: String!
        $visitor_id: String!
    ) {
        deleteCart(
            slug: $slug
            visitor_id: $visitor_id
        ) {
            visitor_id
        }
    }
`
export default DeleteCartMutation
