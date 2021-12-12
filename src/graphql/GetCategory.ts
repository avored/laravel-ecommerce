import gql from 'graphql-tag'

const GetCategory = gql`
  query GetCategory($slug: String!) {
    category(slug: $slug) {
        id 
    }
  }
`
export default GetCategory
