import {get} from 'lodash';
import React, {useState} from 'react'
// import { Link } from 'react-router-dom';
import {useQuery} from 'urql';
import {useAppDispatch, useAppSelector} from '../../app/hooks'
import {FormInput} from '../../components/Form/FormInput';
import {FormLabel} from '../../components/Form/FormLabel';
import {Header} from '../../components/Header'
import {visitorId} from '../../features/cart/cartSlice'
import {useNavigate} from "react-router-dom";
import { getCheckoutInformation, setShippingOption } from '../../features/checkout/checkoutSlice';
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

export const CheckoutShippingShow = () => {

    const navigate = useNavigate()

    const dispatch = useAppDispatch();

    const stateCheckout = useAppSelector(getCheckoutInformation);

    const [shipping, setShipping] = useState('FREE_SHIPPING');  
    const shippingOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setShipping(e.target.value)
    }

    const submitHandler = () => {
        dispatch(setShippingOption(shipping))
        navigate('/checkout/payment')

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
                                                Shipping Method
                                            </div>

                                            <div className="flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                                <input onChange={shippingOnChange} defaultChecked={(shipping === 'FREE_SHIPPING')} id="bordered-radio-1" type="radio" value="FREE_SHIPPING" name="bordered-radio" className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                <label htmlFor="bordered-radio-1" className="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    Free shipping
                                                </label>
                                            </div>
                                            <div className="flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                                <input onChange={shippingOnChange} defaultChecked={(shipping === 'NZ_POST')}   id="bordered-radio-2" type="radio" value="NZ_POST" name="bordered-radio" className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                <label htmlFor="bordered-radio-2" className="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    Fast Shipping ($ 10.00)
                                                </label>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <button onClick={submitHandler} className="bg-red-500  font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full">
                                    Continue
                                </button>
                                </>
                                )
                }
            </div>
        </AvoRedApp>
    )
}
