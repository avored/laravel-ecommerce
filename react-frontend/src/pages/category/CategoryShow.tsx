import { Menu, Transition } from '@headlessui/react';
import { get } from 'lodash';
import React, { Fragment } from 'react'
import { useParams } from 'react-router-dom';
import { useQuery } from 'urql';
import { Header } from '../../components/Header';
import { ProductCard } from '../../components/ProductCard';
import { Product } from '../../types/ProductType';
import { AvoRedApp } from '../../components/Layout/AvoRedApp';

const GetCategory = `
query GetCategory ($slug: String!) {
  category (slug: $slug) {
      id
      name
      slug
      meta_title
      meta_description
      products {
        data {
            id
            name
            slug
            price
            main_image_url
        }
    }
  }
}
`;

export const CategoryShow = () => {
  let { slug } = useParams();
  const [{ fetching, data }] = useQuery({ query: GetCategory, variables: { slug } });
  
  return (
    <AvoRedApp>
      {fetching === true ? (
          <p>Loading</p>
      ) : (
        <>
        <header className="bg-white shadow">
          <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 className="text-3xl font-bold tracking-tight text-gray-900">
              {get(data, 'category.name')}
            </h1>
          </div>
        </header>
        <main>
          <div className="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div className="px-4 py-6 sm:px-0">
                {JSON.stringify(get(data, 'category.products.data'))}
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
                          
                        </h1>

                        <div className="flex items-center">
                          <Menu as="div" className="relative inline-block text-left">
                              <Menu.Button className="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" id="menu-button" aria-expanded="false" aria-haspopup="true">
                                Sort
                                <svg className="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fillRule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clipRule="evenodd" />
                                </svg>
                              </Menu.Button>
                            <Transition
                              as={Fragment}
                              enter="transition ease-out duration-100"
                              enterFrom="transform opacity-0 scale-95"
                              enterTo="transform opacity-100 scale-100"
                              leave="transition ease-in duration-75"
                              leaveFrom="transform opacity-100 scale-100"
                              leaveTo="transform opacity-0 scale-95"
                            >
                              <Menu.Items className="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button">
                                <div className="py-1" role="none">
                                  <Menu.Item>
                                    <a href="#" className="text-gray-500 block px-4 py-2 text-sm" role="menuitem" id="menu-item-3">Price: Low to High</a>
                                  </Menu.Item>
                                  <Menu.Item>
                                    <a href="#" className="text-gray-500 block px-4 py-2 text-sm" role="menuitem" id="menu-item-4">Price: High to Low</a>
                                  </Menu.Item>
                                </div>

                              </Menu.Items>

                            </Transition>
                          </Menu>

                          <button type="button" className="-m-2 ml-5 p-2 text-gray-400 hover:text-gray-500 sm:ml-7">
                            <span className="sr-only">View grid</span>
                            <svg className="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fillRule="evenodd" d="M4.25 2A2.25 2.25 0 002 4.25v2.5A2.25 2.25 0 004.25 9h2.5A2.25 2.25 0 009 6.75v-2.5A2.25 2.25 0 006.75 2h-2.5zm0 9A2.25 2.25 0 002 13.25v2.5A2.25 2.25 0 004.25 18h2.5A2.25 2.25 0 009 15.75v-2.5A2.25 2.25 0 006.75 11h-2.5zm9-9A2.25 2.25 0 0011 4.25v2.5A2.25 2.25 0 0013.25 9h2.5A2.25 2.25 0 0018 6.75v-2.5A2.25 2.25 0 0015.75 2h-2.5zm0 9A2.25 2.25 0 0011 13.25v2.5A2.25 2.25 0 0013.25 18h2.5A2.25 2.25 0 0018 15.75v-2.5A2.25 2.25 0 0015.75 11h-2.5z" clipRule="evenodd" />
                            </svg>
                          </button>
                          <button type="button" className="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden">
                            <span className="sr-only">Filters</span>
                            <svg className="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fillRule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clipRule="evenodd" />
                            </svg>
                          </button>
                        </div>
                      </div>

                      <section aria-labelledby="products-heading" className="pt-6 pb-24">
                          <h2 id="products-heading" className="sr-only">Products</h2>
                          <div className="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                          {get(data, 'category.products.data', []).map((product: Product) => {
                              return <ProductCard key={product.id} product={product} />
                          })}
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
    </AvoRedApp>

  )
}
