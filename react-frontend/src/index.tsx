import React from "react"
import ReactDOM from "react-dom/client"
import "./index.css";
import App from "./App"
import { BrowserRouter } from "react-router-dom"
import { AuthContextProvider } from "./context/AuthContext"
import { Provider, Client, dedupExchange, fetchExchange } from 'urql'
import { cacheExchange } from '@urql/exchange-graphcache'

const cache = cacheExchange({})

const client = new Client({
  url: 'https://avored-backend.test/graphql',
  exchanges: [dedupExchange, cache, fetchExchange],
})

const root = ReactDOM.createRoot(
  document.getElementById("root") as HTMLElement
);
root.render(
  <AuthContextProvider>
    <BrowserRouter >
        <Provider value={client}>
            <App />
        </Provider>
    </BrowserRouter>
  </AuthContextProvider>
);
