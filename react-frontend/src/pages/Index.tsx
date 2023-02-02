import React from "react";
import { Header } from "../components/Header";
import {FormattedMessage} from 'react-intl';
import { AvoRedApp } from "../components/Layout/AvoRedApp";

export const Index = () => {
  return (
    <AvoRedApp>
      <header className="bg-white shadow">
        <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold tracking-tight text-gray-900">
          <FormattedMessage id="home_page" />
            AvoRed E commerce Demo
          </h1>
        </div>
      </header>
      <main>
        <div className="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
          <div className="px-4 py-6 sm:px-0">
            <section>
              <div className="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
                <header className="text-center">
                  <h2 className="text-xl font-bold text-gray-900 sm:text-3xl">
                    New Collection
                  </h2>

                  <p className="max-w-md mx-auto mt-4 text-gray-500">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque
                    praesentium cumque iure dicta incidunt est ipsam, officia dolor fugit
                    natus?
                  </p>
                </header>

                <ul className="grid grid-cols-1 gap-4 mt-8 lg:grid-cols-3">
                  <li>
                    <a href="#" className="relative block group">
                      <img
                        src="https://images.unsplash.com/photo-1618898909019-010e4e234c55?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                        alt=""
                        className="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90"
                      />

                      <div
                        className="absolute inset-0 flex flex-col items-start justify-end p-6"
                      >
                        <h3 className="text-xl font-medium text-white">PHP</h3>

                        <span
                          className="mt-1.5 inline-block bg-black px-5 py-3 text-xs font-medium uppercase tracking-wide text-white"
                        >
                          Shop Now
                        </span>
                      </div>
                    </a>
                  </li>

                  <li>
                    <a href="#" className="relative block group">
                      <img
                        src="https://images.unsplash.com/photo-1624623278313-a930126a11c3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                        alt=""
                        className="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90"
                      />

                      <div
                        className="absolute inset-0 flex flex-col items-start justify-end p-6"
                      >
                        <h3 className="text-xl font-medium text-white">Laravel</h3>

                        <span
                          className="mt-1.5 inline-block bg-black px-5 py-3 text-xs font-medium uppercase tracking-wide text-white"
                        >
                          Shop Now
                        </span>
                      </div>
                    </a>
                  </li>

                  <li className="lg:col-span-2 lg:col-start-2 lg:row-span-2 lg:row-start-1">
                    <a href="#" className="relative block group">
                      <img
                        src="https://images.unsplash.com/photo-1593795899768-947c4929449d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2672&q=80"
                        alt=""
                        className="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90"
                      />

                      <div
                        className="absolute inset-0 flex flex-col items-start justify-end p-6"
                      >
                        <h3 className="text-xl font-medium text-white">AvoRed</h3>

                        <span
                          className="mt-1.5 inline-block bg-black px-5 py-3 text-xs font-medium uppercase tracking-wide text-white"
                        >
                          Shop Now
                        </span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </section>

          </div>
        </div>
      </main>
    </AvoRedApp>
  );
};
