import gql from 'graphql-tag'

const UpdateCartMutation = gql`
    mutation UpdateCartMutation (
        $slug: String!
        $visitor_id: String!
        $qty: Float!
    ) {
        updateCart(
            slug: $slug
            visitor_id: $visitor_id
            qty: $qty
        ) {
            visitor_id
            product_id
            qty
        }
    }
`
export default UpdateCartMutation
