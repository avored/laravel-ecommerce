import gql from 'graphql-tag'

const ShippingQuery = gql`
    query ShippingQuery{
        shippingQuery {
                name
                identifier
                view
        }
    }
`
export default ShippingQuery
