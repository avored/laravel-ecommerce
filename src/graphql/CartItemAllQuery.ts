import gql from 'graphql-tag'

const CartItemAllQuery = gql`
    query CartItemAllQuery {
        cartItems {
                visitor_id
                product_id
                product {
                    id
                    name
                    price
                    main_image_url
                }
                qty
        }
    }
`
export default CartItemAllQuery
