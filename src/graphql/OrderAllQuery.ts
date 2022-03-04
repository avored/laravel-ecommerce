import gql from 'graphql-tag'

const OrderAllQuery = gql`
    query AllOrders{
        allOrders {
            id
            shipping_option
            payment_option
            order_status_name
            created_at
            updated_at
        }
    }
`
export default OrderAllQuery
