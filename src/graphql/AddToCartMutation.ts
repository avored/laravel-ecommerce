import gql from 'graphql-tag'

const AddToCart = gql`
    mutation AddToCart(
        $slug: String!
        $qty: Float!
        $visitor_id: String
    ) {
        addToCart(
            slug: $slug
            qty: $qty
            visitor_id: $visitor_id
        )  {
            visitor_id
            product_id
            qty
        }
    }
`
export default AddToCart
