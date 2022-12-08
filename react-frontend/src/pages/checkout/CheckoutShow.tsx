import { get } from 'lodash';
import React from 'react'
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


export const CheckoutShow = () => {

  const currentVisitorId = useAppSelector(visitorId)
  const [{ fetching, data }] = useQuery({ query: GetCartItems, variables: { visitorId: currentVisitorId } });
  return (
    <>
    <Header />
    <div className="mx-auto max-w-7xl">
      {fetching === true ? (
          <p>Loading</p>
      ) : (
        <>
        <div className="flex my-10">
          
          <div id="summary" className="w-1/4 px-8 py-10">
            
            
            <div className="border-t mt-8">
              
              <button className="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Place Order</button>
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
