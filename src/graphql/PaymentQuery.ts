import gql from 'graphql-tag'

const PaymentQuery = gql`
    query PaymentQuery{
            paymentQuery {
                    name
                    identifier
                    view
            }
        }
`
export default PaymentQuery
