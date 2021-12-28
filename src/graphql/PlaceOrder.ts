import gql from 'graphql-tag'

const PlaceOrder = gql`
    mutation PlaceOrderMutation (
        $shipping_option: String!
        $payment_option: String!
        $order_status_id: String!
        $customer_id: String! 
        $shipping_address_id: String!
        $billing_address_id: String!
    ) {
        placeOrder (
            shipping_option: $shipping_option
            payment_option: $payment_option
            order_status_id: $order_status_id
            customer_id: $customer_id
            shipping_address_id: $shipping_address_id
            billing_address_id: $billing_address_id
        ) {
            id 
            shipping_option
            payment_option
            order_status_id
            shipping_address_id
            billing_address_id
            track_code
            created_at
            updated_at
        }
    }
`
export default PlaceOrder
