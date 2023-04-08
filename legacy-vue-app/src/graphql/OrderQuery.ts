import gql from 'graphql-tag'

const OrderQuery = gql`
    query OrderQuery ($order_id : String!){
    order (
        id: $order_id
    ) {
        id
        shipping_option
        payment_option
        order_status_name
        created_at
        updated_at
        }
    }
`
export default OrderQuery
