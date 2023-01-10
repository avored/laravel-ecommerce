import { get } from 'lodash';
import React, { useState } from 'react'
import { Link } from 'react-router-dom';
import { useQuery } from 'urql';
import { useAppSelector } from '../../app/hooks'
import { Header } from '../../components/Header'
import { visitorId } from '../../features/cart/cartSlice'

const GetCartItems = `
query CartItems($visitorId: String!)  {
  cartItems (visitor_id: $visitorId)  {
      visitor_id
      product_id
      product {
          name
          main_image_url
          price
      }
      qty
  }
}
`;


export const CartShow = () => {

  const currentVisitorId = useAppSelector(visitorId)
  const [{ fetching, data }] = useQuery({ query: GetCartItems, variables: { visitorId: currentVisitorId } });

  var cartTotal: number = 0
  var shippingCost: number = 10.00
  const incrementCartTotal = (itemPrice: number, itemQty: number) => {
    cartTotal += (itemPrice * itemQty)
  }

  const cartItemQtyOnchange = () => {
    console.log('tests')
  }

  

  return (
    <>
    <Header />
    <div className="mx-auto max-w-7xl">
      {fetching === true ? (
          <p>Loading</p>
      ) : (
        <>
        <div className="flex my-10">
          <div className="w-3/4 bg-white px-10 py-10">
            {currentVisitorId}
              <div>
                {JSON.stringify(get(data, 'cartItems'))}
              </div>
            <div className="flex justify-between mt-5 border-b pb-8">
              <h1 className="font-semibold text-2xl">Shopping Cart</h1>
              <h2 className="font-semibold text-2xl">{get(data, 'cartItems', []).length} Items</h2>
            </div>
            <div className="flex mt-10 mb-5">
              <h3 className="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
              <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
              <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
              <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
            </div>
            {get(data, 'cartItems', []).map((cartItem:any) => {

              incrementCartTotal(get(cartItem, 'product.price'), get(cartItem, 'qty', 1))
              return (<div key={get(cartItem, 'product.id')} className="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                <div className="flex w-2/5">
                  <div className="w-20">
                    <img className="h-24" src={get(cartItem, 'product.main_image_url')} alt={get(cartItem, 'product.name')} />
                  </div>
                  <div className="flex flex-col justify-between ml-4 flex-grow">
                    <span className="font-bold text-sm">{get(cartItem, 'product.name')}</span>
                    <a href="#" className="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                  </div>
                </div>
                <div className="flex justify-center w-1/5">
                  <input
                    name="qty"
                    type="text"
                    onChange={cartItemQtyOnchange}
                    value={get(cartItem, 'qty')}
                    className="mx-2 border text-center w-24 rounded border-gray-300 px-3 py-2 text-gray-900 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm"
                  />
                </div>
                <span className="text-center w-1/5 font-semibold text-sm">${get(cartItem, 'product.price')}</span>
                <span className="text-center w-1/5 font-semibold text-sm">${get(cartItem, 'product.price') * get(cartItem, 'qty')}</span>
              </div>)
            })}

            

            <Link to="/" className="flex font-semibold text-indigo-600 text-sm mt-10">
          
              <svg className="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
              Continue Shopping
            </Link>
          </div>

          <div id="summary" className="w-1/4 px-8 py-10">
            <h1 className="font-semibold text-2xl border-b pb-8">Order Summary</h1>
            <div className="flex justify-between mt-10 mb-5">
              <span className="font-semibold text-sm uppercase">Items {get(data, 'cartItems', []).len}</span>
              <span className="font-semibold text-sm">$ {cartTotal}</span>
            </div>
            <div>
              <label className="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
              <select className="block p-2 text-gray-600 w-full text-sm">
                <option>Standard shipping - $10.00</option>
              </select>
            </div>
            
            <div className="border-t mt-8">
              <div className="flex font-semibold justify-between py-6 text-sm uppercase">
                <span>Total cost</span>
                <span>$ {cartTotal + shippingCost}</span>
              </div>
              <Link to="/checkout">
                  <button className="bg-red-500 font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full">
                      Checkout
                  </button>
              </Link>
            </div>
          </div>

        </div>
        </>
      )
      }
    </div>
    </>
  )
}
