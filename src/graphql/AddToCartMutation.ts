import gql from 'graphql-tag'

const AddToCart = gql`
    mutation AddToCart(
        $slug: String!
        $qty: Float!
    ) {
        addToCart(
            slug: $slug
            qty: $qty
        )  {
            visitor_id
            product_id
            price
            qty
        }
    }
`
export default AddToCart
