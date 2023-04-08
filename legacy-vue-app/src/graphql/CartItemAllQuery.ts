import gql from 'graphql-tag'

const CartItemAllQuery = gql`
    query CartItemAllQuery (
        $visitor_id: String!
    ) {
        cartItems (
            visitor_id: $visitor_id
        ) {
                visitor_id
                product_id
                product {
                    id
                    name
                    slug
                    price
                    main_image_url
                }
                qty
        }
    }
`
export default CartItemAllQuery
