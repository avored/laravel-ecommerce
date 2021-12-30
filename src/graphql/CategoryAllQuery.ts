import gql from 'graphql-tag'

const CategoryAllQuery = gql`
    query CategoryAllQuery {
        allCategory {
            name
            slug
        }
    }
`
export default CategoryAllQuery
