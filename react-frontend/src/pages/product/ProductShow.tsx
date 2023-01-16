import { get, isEmpty } from 'lodash';
import React, { useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom';
import { useMutation, useQuery } from 'urql';
import { useAppDispatch, useAppSelector } from '../../app/hooks';
import { Header } from '../../components/Header';
import { setVisitorId, visitorId } from '../../features/cart/cartSlice';
import { AvoRedApp } from '../../components/Layout/AvoRedApp';

const GetProduct = `
query GetProduct ($slug: String!) {
  product (slug: $slug) {
    id
    name
    sku
    slug
    description
    price
    main_image_url
  }
}
`;

const AddToCartMutation = `
    mutation AddToCart(
      $visitorId: String,
      $slug: String!, 
      $qty: Float!
    ) {
      addToCart(
        visitor_id: $visitorId,
        slug: $slug, 
        qty: $qty
      ) {
          visitor_id
          product_id
          product {
            main_image_url
            price
            name
          }
          qty
      }
    }
`;

export const ProductShow = () => {

  let { slug } = useParams();
  const navigate = useNavigate();
  const dispatch = useAppDispatch();
  const [qty, setQty] = useState(1);
  const currentVisitorId = useAppSelector(visitorId)

  const [addToCartMutationResult, addToCartMutation] = useMutation(AddToCartMutation)

  const addToCartOnClick = () => {
    var variables = {}
    if (isEmpty(currentVisitorId)) {
      variables = {slug, qty}
    } else {
      variables = {slug, qty, visitorId: currentVisitorId}
    }
    addToCartMutation(variables).then ((result) => {
        if (isEmpty(currentVisitorId)) {
          const cartVisitorId: string = get(result, 'data.addToCart.0.visitor_id')
          dispatch(setVisitorId(cartVisitorId))
        }
        navigate('/cart')     
    })

  }

  const [{ fetching, data }] = useQuery({ query: GetProduct, variables: { slug } });

  return (
      <AvoRedApp>
        VisitorID: {currentVisitorId}
  
        {fetching === true ? (
            <p>Loading</p>
        ) : (
          <>
          <header className="bg-white shadow">
            <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
              <h1 className="text-3xl font-bold tracking-tight text-gray-900">
                {get(data, 'product.name')}
              </h1>
              <p className="mt-1 text-sm text-gray-500">SKU: #{get(data, 'product.sku')}</p>
              <p className="mt-1 text-sm text-gray-500">{currentVisitorId}</p>
            </div>
          </header>
        
  
  <section>
    <div className="relative mx-auto max-w-screen-xl px-4 py-8">
      <div className="grid gap-8 lg:grid-cols-4 lg:items-start">
        <div className="lg:col-span-3">
          <div className="relative mt-4">
            <img
              alt={get(data, 'product.name')}
              src={get(data, 'product.main_image_url')}
              className="h-72 w-full rounded-xl object-cover lg:h-[540px]"
            />
  
            {/* <div
              className="absolute bottom-4 left-1/2 inline-flex -translate-x-1/2 items-center rounded-full bg-black/75 px-3 py-1.5 text-white"
            >
              <svg
                className="h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"
                />
              </svg>
  
              <span className="ml-1.5 text-xs"> Hover to zoom </span>
            </div> */}
          </div>
            <div>
  
            
          {/* <ul className="mt-1 flex gap-1">
            <li>
              <img
                alt="Tee"
                src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                className="h-16 w-16 rounded-md object-cover"
              />
            </li>
  
            <li>
              <img
                alt="Tee"
                src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                className="h-16 w-16 rounded-md object-cover"
              />
            </li>
  
            <li>
              <img
                alt="Tee"
                src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                className="h-16 w-16 rounded-md object-cover"
              />
            </li>
  
            <li>
              <img
                alt="Tee"
                src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                className="h-16 w-16 rounded-md object-cover"
              />
            </li>
          </ul> */}
          </div>
        </div>
  
        <div className="lg:sticky lg:top-0">
          <div className="space-y-4 lg:pt-4">
            {/* <fieldset>
              <legend className="text-lg font-bold">Color</legend>
  
              <div className="mt-2 flex gap-1">
                <label htmlFor="color_green" className="cursor-pointer">
                  <input
                    type="radio"
                    id="color_green"
                    name="color"
                    className="peer sr-only"
                    checked
                  />
  
                  <span
                    className="block h-6 w-6 rounded-full border border-gray-200 bg-green-700 ring-1 ring-transparent ring-offset-1 peer-checked:ring-gray-300"
                  ></span>
                </label>
  
                <label htmlFor="color_blue" className="cursor-pointer">
                  <input
                    type="radio"
                    id="color_blue"
                    name="color"
                    className="peer sr-only"
                  />
  
                  <span
                    className="block h-6 w-6 rounded-full border border-gray-200 bg-blue-700 ring-1 ring-transparent ring-offset-1 peer-checked:ring-gray-300"
                  ></span>
                </label>
  
                <label htmlFor="color_pink" className="cursor-pointer">
                  <input
                    type="radio"
                    id="color_pink"
                    name="color"
                    className="peer sr-only"
                  />
  
                  <span
                    className="block h-6 w-6 rounded-full border border-gray-200 bg-pink-700 ring-1 ring-transparent ring-offset-1 peer-checked:ring-gray-300"
                  ></span>
                </label>
  
                <label htmlFor="color_red" className="cursor-pointer">
                  <input
                    type="radio"
                    id="color_red"
                    name="color"
                    className="peer sr-only"
                  />
  
                  <span
                    className="block h-6 w-6 rounded-full border border-gray-200 bg-red-700 ring-1 ring-transparent ring-offset-1 peer-checked:ring-gray-300"
                  ></span>
                </label>
  
                <label htmlFor="color_indigo" className="cursor-pointer">
                  <input
                    type="radio"
                    id="color_indigo"
                    name="color"
                    className="peer sr-only"
                  />
  
                  <span
                    className="block h-6 w-6 rounded-full border border-gray-200 bg-indigo-700 ring-1 ring-transparent ring-offset-1 peer-checked:ring-gray-300"
                  ></span>
                </label>
              </div>
            </fieldset>
  
            <fieldset>
              <legend className="text-lg font-bold">Material</legend>
  
              <div className="mt-2 flex gap-1">
                <label htmlFor="material_cotton" className="cursor-pointer">
                  <input
                    type="radio"
                    id="material_cotton"
                    name="material"
                    className="peer sr-only"
                    checked
                  />
  
                  <span
                    className="block rounded-full border border-gray-200 px-3 py-1 text-xs peer-checked:bg-gray-100"
                  >
                    Cotton
                  </span>
                </label>
  
                <label htmlFor="material_wool" className="cursor-pointer">
                  <input
                    type="radio"
                    id="material_wool"
                    name="material"
                    className="peer sr-only"
                    checked
                  />
  
                  <span
                    className="block rounded-full border border-gray-200 px-3 py-1 text-xs peer-checked:bg-gray-100"
                  >
                    Wool
                  </span>
                </label>
              </div>
            </fieldset> */}
  
            <div className="rounded border bg-gray-100 p-4">
              <p className="text-sm">
                <span className="block"> Pay as low as $3/mo with 0% APR. </span>
  
                <a href="" className="mt-1 inline-block underline"> Find out more </a>
              </p>
            </div>
  
            <div>
              <div className="mb-3 rounded-md shadow-sm">
                  <label htmlFor="qty" className="text-gray-500 pl-1">
                    QTY
                  </label>
                  <input
                    id="qty"
                    name="qty"
                    onChange={(e) => {setQty(parseFloat(e.target.value))}}
                    type="number"
                    value={qty}
                    className="block w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm"
                    placeholder="Qty"
                  />
                </div>
              <p className="text-xl font-bold">${get(data, 'product.price')}</p>
            </div>
  
            <button
              type="button"
              onClick={addToCartOnClick}
              className="w-full rounded bg-red-700 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white"
            >
              Add to cart
            </button>
  
            {/* <button
              type="button"
              className="w-full rounded border border-gray-300 bg-gray-100 px-6 py-3 text-sm font-bold uppercase tracking-wide"
            >
              Notify when on sale
            </button> */}
          </div>
        </div>
  
        <div className="lg:col-span-3">
          <div
            className="prose max-w-none [&>iframe]:mt-6 [&>iframe]:aspect-video [&>iframe]:w-full [&>iframe]:rounded-xl"
          >
           {get(data, 'product.description')}
          </div>
        </div>
      </div>
    </div>
  </section>
  
          </>
        )
        }
      </AvoRedApp>
  )
}
