import gql from 'graphql-tag'

const LatestProductQuery = gql`
    query LatestProductQuery {
      latestProductQuery {
          name
          slug
          main_image_url
          price
      }
  }
`
export default LatestProductQuery
