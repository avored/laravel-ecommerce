import React from "react";
import { createRoot } from "react-dom/client";
import { Provider } from "react-redux";
import { store } from "./app/store";
import App from "./App";
import "./index.css";
import { BrowserRouter } from "react-router-dom";
import { cacheExchange, createClient, dedupExchange, Provider  as GraphqlProvider } from 'urql';

import {IntlProvider} from 'react-intl';
import French from './lang/fr.json';
import English from './lang/en.json';
import { useAppSelector } from "./app/hooks";
import { getAuthUserInfo } from "./features/userLogin/userLoginSlice";
import { get } from "lodash";
import { multipartFetchExchange } from "@urql/exchange-multipart-fetch";

const locale:string = "en";

let lang;
  if (locale === "en") {
    lang = English;
  } 
  if (locale === "fr") {
      lang = French;
  }


const graphQLUrl: string = process.env.REACT_APP_GRAPHQL_URL ?? 'http://localhost:8000/graphql'


const client = createClient({
  url: graphQLUrl,
  exchanges: [
    dedupExchange,
    cacheExchange,
    multipartFetchExchange,
  ],
  fetchOptions: () => {
    const token = getToken()
    return {
      headers: { authorization: token ? `Bearer ${token}` : '' },

    };
  },

});


function getToken (): string|null {
  return localStorage.getItem('access_token')
}


const container = document.getElementById("root")!;
const root = createRoot(container);

root.render(
  <React.StrictMode>
    <Provider store={store}>
      <IntlProvider locale ={locale} messages={lang}>
        <BrowserRouter>
          <GraphqlProvider value={client}>
            <App />
          </GraphqlProvider>
        </BrowserRouter>
        </IntlProvider>
    </Provider>
  </React.StrictMode>
);
