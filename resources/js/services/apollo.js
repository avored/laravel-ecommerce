
import Vue from 'vue'
import { ApolloClient } from 'apollo-client'
import { createHttpLink } from 'apollo-link-http'
import { createUploadLink } from 'apollo-upload-client'
import { BatchHttpLink } from 'apollo-link-batch-http'
import { ApolloLink, concat, split } from 'apollo-link'
import { InMemoryCache } from 'apollo-cache-inmemory'
import VueApollo from 'vue-apollo'
import { AUTH_TOKEN } from '@/modules/system/constants/index'

const token = localStorage.getItem(AUTH_TOKEN) || null

Vue.use(VueApollo)


const httpOptions = {
  uri: 'https://laravel-ecommerce.test/graphql'
}



// HTTP connection to the API
const httpLink = split(
  operation => operation.getContext().hasUpload,
  createUploadLink(httpOptions),
  new BatchHttpLink(httpOptions)
)


const authMiddleware = new ApolloLink((operation, forward) => {
  // convert this into an method 
  // currently it is causing an issue to refresh page after login otherwise its not working
  operation.setContext({
    headers: {
      authorization: `Bearer ${token}`,
    }
  });
  return forward(operation);
})

// Cache implementation
const cache = new InMemoryCache()

// Create the apollo client
const apolloClient = new ApolloClient({
  // link: httpLink,
  link: concat(authMiddleware, httpLink),
  cache,
})


const apolloProvider = new VueApollo({
  defaultClient: apolloClient,
})

export default apolloProvider
