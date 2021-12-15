import gql from 'graphql-tag'

const GetCategoryQuery = gql`
    query GetCategoryQuery($slug: String!) {
      category(slug: $slug) {
          id
          name
          products {
            id
            slug
            name
            price
            main_image_url
          }
      }
    }
`
export default GetCategoryQuery
