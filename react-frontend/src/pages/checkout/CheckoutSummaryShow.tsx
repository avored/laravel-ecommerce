import {get, isEmpty} from 'lodash';
import React, {useState} from 'react'
// import { Link } from 'react-router-dom';
import {useMutation, useQuery} from 'urql';
import {useAppSelector} from '../../app/hooks'
import {FormInput} from '../../components/Form/FormInput';
import {FormLabel} from '../../components/Form/FormLabel';
import {Header} from '../../components/Header'
import {visitorId} from '../../features/cart/cartSlice'
import {useNavigate} from "react-router-dom";
import { getCheckoutInformation } from '../../features/checkout/checkoutSlice';
import { AvoRedApp } from '../../components/Layout/AvoRedApp';

const GetCartItems = `
query CartItems($visitorId: String!)  {
    cartItems (visitor_id: $visitorId)  {
        visitor_id
        product_id
        qty
        product {
            name
            main_image_url
            price
        }

    }
}
`;

const PlaceOrderMutationQuery = `
    mutation PlaceOrderMutation (
        $shipping_option: String!
        $payment_option: String!
        $shipping_address_id: String!
        $billing_address_id: String!
    ) {
        placeOrder (
            shipping_option: $shipping_option
            payment_option: $payment_option
            shipping_address_id: $shipping_address_id
            billing_address_id: $billing_address_id
        ) {
            id 
            shipping_option
            payment_option
            order_status_id
            shipping_address_id
            billing_address_id
            track_code
            created_at
            updated_at
        }
    }
`;

export const CheckoutSummaryShow = () => {

    const navigate = useNavigate()
    
    const stateCheckout = useAppSelector(getCheckoutInformation);
    const [placeOrderMutationResult, placeOrderMutation] = useMutation(PlaceOrderMutationQuery)

    const submitHandler = () => {
        const variables = {
            shipping_address_id: stateCheckout.shipping_address_id,
            billing_address_id: stateCheckout.billing_address_id,
            shipping_option: stateCheckout.shipping_option,
            payment_option: stateCheckout.payment_option
        }

        console.log(variables)
        placeOrderMutation(variables).then(({ data }) => {
            if (!isEmpty(data.placeOrder.id)) {
                navigate('/')
            }
        });

    }

    // var cartTotal: number = 0
    // var shippingCost: number = 10.00
    const incrementCartTotal = (itemPrice: number, itemQty: number) => {
        // cartTotal += (itemPrice * itemQty)
    }
    const currentVisitorId = useAppSelector(visitorId)
    const [{fetching, data}] = useQuery({query: GetCartItems, variables: {visitorId: currentVisitorId}});
    return (
        <AvoRedApp>
            <div className="mx-auto my-5 max-w-7xl">
                {JSON.stringify(stateCheckout)}
            </div>
            <div className="mx-auto max-w-7xl">
                {fetching == true ? (
                        <p>Loading</p>
                        ) : (
                                <>
                                <div className="flex  my-10">
                                    <div id="summary" className="w-1/2 border border-red-500 px-3 py-5">
                                        <div className="flex mt-10 mb-5">
                                            <h3 className="font-semibold text-gray-600 text-xs uppercase w-2/5">Product
                                                Details</h3>
                                            <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                                            <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                                            <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                                        </div>
                                        {get(data, 'cartItems', []).map((cartItem: any) => {

                                            incrementCartTotal(get(cartItem, 'product.price'), get(cartItem, 'qty', 1))
                                            return (<div className="flex items-center hover:bg-gray-100 py-5">
                                                <div className="flex w-2/5">
                                                    <div className="w-20">
                                                        <img className="h-24" src={get(cartItem, 'product.main_image_url')}
                                                            alt={get(cartItem, 'product.name')}/>
                                                    </div>
                                                    <div className="flex flex-col justify-between ml-4 flex-grow">
                                                        <span
                                                            className="font-bold text-sm">{get(cartItem, 'product.name')}</span>
                                                        <div
                                                            className="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="flex justify-center w-1/5">
                                                    <input
                                                        name="qty"
                                                        type="text"
                                                        value={get(cartItem, 'qty')}
                                                        className="mx-2 border text-center w-24 rounded border-gray-300 px-3 py-2 text-gray-900 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm"
                                                    />
                                                </div>
                                                <span
                                                    className="text-center w-1/5 font-semibold text-sm">${get(cartItem, 'product.price')}</span>
                                                <span
                                                    className="text-center w-1/5 font-semibold text-sm">${get(cartItem, 'product.price') * get(cartItem, 'qty')}</span>
                                            </div>)
                                        })}
                                    </div>
                                    <div id="order-info" className="w-1/2 border border-red-500 px-3 py-5">
                                        <div className="border border-gray-300 rounded shadow-sm">
                                            <div className="p-3 border-b ">
                                                Order Summary
                                            </div>

                                        


                                        </div>
                                    </div>

                                </div>
                                <button onClick={submitHandler} className="bg-red-500  font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full">
                                    Place Order
                                </button>
                                </>
                                )
                }
            </div>
        </AvoRedApp>
    )
}
