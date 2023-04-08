import gql from 'graphql-tag'

const CountryOptionsQuery = gql`
    query {
        countryOptions {
            label
            value
        }
    }
`
export default CountryOptionsQuery
