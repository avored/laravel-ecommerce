import gql from 'graphql-tag'

const GetCategoryQuery = gql`
    query GetCategoryQuery(
      $slug: String!
      $page : Int
    ) {
      category(
        slug: $slug
        page: $page
      ) {
          id
          name
          products {
            total
            per_page
            current_page
            from
            to
            last_page
            has_more_pages
            data {
              id
              slug
              name
              price
              main_image_url
            }
          }
      }
    }
`
export default GetCategoryQuery
