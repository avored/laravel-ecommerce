import React from "react";
import { createRoot } from "react-dom/client";
import { Provider } from "react-redux";
import { store } from "./app/store";
import App from "./App";
import "./index.css";
import { BrowserRouter } from "react-router-dom";
import { createClient, Provider  as GraphqlProvider } from 'urql';

const client = createClient({
  url: 'http://localhost:8000/graphql',
  // fetchOptions: () => {
  //   const token = getToken();
  //   return {
  //     headers: { authorization: token ? `Bearer ${token}` : '' },
  //   };
  // },
});


function getToken (): string {
  return 'abcd'
}


const container = document.getElementById("root")!;
const root = createRoot(container);

root.render(
  <React.StrictMode>
    <Provider store={store}>
      <BrowserRouter>
        <GraphqlProvider value={client}>
          <App />
        </GraphqlProvider>
      </BrowserRouter>
    </Provider>
  </React.StrictMode>
);
