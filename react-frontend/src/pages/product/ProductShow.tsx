import { Menu, Transition } from '@headlessui/react';
import { get } from 'lodash';
import React, { Fragment } from 'react'
import { useParams } from 'react-router-dom';
import { useQuery } from 'urql';
import { Header } from '../../components/Header';
import { ProductCard } from '../../components/ProductCard';
import { Product } from '../../types/ProductType';

const GetProduct = `
query GetProduct ($slug: String!) {
  product (slug: $slug) {
    id
    name
    slug
    price
    main_image_url
  }
}
`;

export const ProductShow = () => {

  let { slug } = useParams();
  // let { slug } = useParams();

  const [{ fetching, data }] = useQuery({ query: GetProduct, variables: { slug } });

  const product = { name : 'Basic Tee'};

  return (
    <div className="min-h-full">
      <Header />

      {fetching === true ? (
          <p>Loading</p>
      ) : (
        <>
        <header className="bg-white shadow">
          <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 className="text-3xl font-bold tracking-tight text-gray-900">
              {get(data, 'product.name')}
            </h1>
          </div>
        </header>
        <main>
          <div className="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div className="px-4 py-6 sm:px-0">
                {JSON.stringify(get(data, 'product'))}
              <div className="h-96">

                <div className="bg-white">
                  <div>

                    <div className="relative z-40 lg:hidden" role="dialog" aria-modal="true">

                      <div className="fixed inset-0 bg-black bg-opacity-25"></div>

                      <div className="fixed inset-0 z-40 flex">

                        <div className="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                          <div className="flex items-center justify-between px-4">
                            <h2 className="text-lg font-medium text-gray-900">Filters</h2>
                            <button type="button" className="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400">
                              <span className="sr-only">Close menu</span>
                              <svg className="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" aria-hidden="true">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <main className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                      <div className="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
                        <h1 className="text-4xl font-bold tracking-tight text-gray-900">
                            {get(data, 'product.name')}
                        </h1>
                      </div>
                      <section aria-labelledby="products-heading" className="pt-6 pb-24">
                          <h2 id="products-heading" className="sr-only">Products</h2>
                          <div className="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                         
                          </div>
                      </section>
                    </main>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
        </>
      )
      }
    </div>
  )
}
