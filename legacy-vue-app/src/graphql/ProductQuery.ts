import gql from 'graphql-tag'

const ProductQuery = gql`
    query ProductQuery ($slug: String!) {
        product(slug: $slug) {
            id
            name
            slug
            price
            description
        }
    }
`
export default ProductQuery
