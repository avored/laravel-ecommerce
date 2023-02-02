import {get} from 'lodash';
import React, {useState} from 'react'
import { getAuthUserInfo } from '../../features/userLogin/userLoginSlice'
import {useQuery} from 'urql';
import { isEmpty } from 'lodash';
import {useAppDispatch, useAppSelector} from '../../app/hooks'
import {FormInput} from '../../components/Form/FormInput';
import {FormLabel} from '../../components/Form/FormLabel';
import {Header} from '../../components/Header'
import {visitorId} from '../../features/cart/cartSlice'
import {useNavigate} from "react-router-dom";
import { setCustomerId } from '../../features/checkout/checkoutSlice';
import { AvoRedApp } from '../../components/Layout/AvoRedApp';

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
    const navigate = useNavigate();
    const dispatch = useAppDispatch();

    const currentUserInfo = useAppSelector(getAuthUserInfo);
    if (!isEmpty(currentUserInfo.id)) {
        dispatch(setCustomerId(currentUserInfo.id))
        
        navigate('/checkout/shipping-address')
    }
    const [email, setEmail] = useState('')
    const [firstName, setFirstName] = useState('')
    const [lastName, setLastName] = useState('')
    const [companyName, setCompanyName] = useState('')
    const [password, setPassword] = useState('')
    const [passwordComfirmation, setPasswordComfirmation] = useState('')

    

    const emailOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setEmail(e.target.value)
    }
    const firstNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setFirstName(e.target.value)
    }
    const lastNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setLastName(e.target.value)
    }
    const companyNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setCompanyName(e.target.value)
    }
    const passwordOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setPassword(e.target.value)
    }
    const passwordConfirmationOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setPasswordComfirmation(e.target.value)
    }

    const submitHandler = () => {
        console.log('Click Submit')
        navigate('/checkout/shipping-address')
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
                                    return (<div key={get(cartItem, 'product.id')}  className="flex items-center hover:bg-gray-100 py-5">
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
                                        Your Information
                                    </div>

                                    <div className="space-y-1 rounded-md shadow-sm">
                                        <FormLabel forId="first-name" labelText="First Name"/>
                                        <FormInput value={firstName} id="first-name" type="text" setOnChange={firstNameOnChange}
                                                    placeholder="First Name"/>
                                    </div>

                                    <div className="space-y-1 rounded-md shadow-sm">
                                        <FormLabel forId="last-name" labelText="Last name"/>
                                        <FormInput value={lastName} id="last-name" type="text" setOnChange={lastNameOnChange}
                                                    placeholder="Last name"/>
                                    </div>

                                    <div className="space-y-1 rounded-md shadow-sm">
                                        <FormLabel forId="email-address" labelText="Email address"/>
                                        <FormInput value={email} id="email-address" type="email" setOnChange={emailOnChange}
                                                    placeholder="Email address"/>
                                    </div>

                                    <div className="space-y-1 rounded-md shadow-sm">
                                        <FormLabel forId="company-name" labelText="Company Name"/>
                                        <FormInput value={companyName} id="company-name" type="text" setOnChange={companyNameOnChange}
                                            placeholder="Company Name"/>
                                    </div>

                                    <div className="space-y-1 rounded-md shadow-sm">
                                        <FormLabel forId="password" labelText="Password"/>
                                        <FormInput value={password} id="password" type="password" setOnChange={passwordOnChange}
                                            placeholder="Password"/>
                                    </div>

                                    <div className="space-y-1 rounded-md shadow-sm">
                                        <FormLabel forId="conform-password" labelText="Confirm Password"/>
                                        <FormInput value={passwordComfirmation} id="conform-password" type="password" setOnChange={passwordConfirmationOnChange}
                                            placeholder="Confirm Password"/>
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
