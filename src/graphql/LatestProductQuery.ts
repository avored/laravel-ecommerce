import gql from 'graphql-tag'

const LatestProductQuery = gql`
    query LatestProductQuery{
      latestProductQuery {
          name
          slug
          price
      }
  }
`
export default LatestProductQuery
