import gql from 'graphql-tag'

export const GetCategory = gql`
  query GetCategory($slug: String!) {
    category(slug: $slug) {
        id 
    }
  }
`
