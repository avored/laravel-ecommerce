import {add, get} from 'lodash';
import React, {useState} from 'react'
import {useQuery} from 'urql';
import {useAppDispatch, useAppSelector} from '../../app/hooks'
import {FormInput} from '../../components/Form/FormInput';
import {FormLabel} from '../../components/Form/FormLabel';
import {Header} from '../../components/Header'
import {visitorId} from '../../features/cart/cartSlice'
import {useNavigate} from "react-router-dom";
import { AddressType, getAuthUserInfo } from '../../features/userLogin/userLoginSlice'
import FormSelect, { OptionType } from '../../components/Form/FormSelect';
import { setBillingAddressId, setShippingAddressId } from '../../features/checkout/checkoutSlice';
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


export const CheckoutShippingAddressShow = () => {
    const navigate = useNavigate()
    const currentUserInfo = useAppSelector(getAuthUserInfo);

    const AddressesAllQuery = `
      query AddressAllQuery{
          allAddress {
              id
              type
              first_name
              last_name
              company_name
              phone
              address1
              address2
              city
              state
              postcode
              country_id
              created_at
              updated_at
          }
      }
    `;
    
    const dispatch = useAppDispatch();
    const [addressQueryData] = useQuery({ query: AddressesAllQuery });
    const [selectedAddress, setSelectedAddress] = useState<AddressType>({id: ''})
    const [firstName, setFirstName] = useState('')
    const [lastName, setLastName] = useState('')
    const [companyName, setCompanyName] = useState('')
    const [address1, setAddress1] = useState('')
    const [address2, setAddress2] = useState('')
    const [postcode, setPostcode] = useState('')
    const [city, setCity] = useState('')
    const [countryId, setCountryId] = useState('')
    const [phone, setPhone] = useState('')

    // postcode, city, state, country_id, phone,

    const firstNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setFirstName(e.target.value)
    }
    const lastNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setLastName(e.target.value)
    }
    const companyNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setCompanyName(e.target.value)
    }

    const address1OnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setAddress1(e.target.value)
    }

    const address2OnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setAddress2(e.target.value)
    }

    const postcodeOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setPostcode(e.target.value)
    }

    const cityOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setCity(e.target.value)
    }

    const phoneOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setPhone(e.target.value)
    }

    const countryIdOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setCountryId(e.target.value)
    }

    const customerAddressOnChange = (addressValue: string) : void => {
        console.log(addressValue)
    }

    const addressOptions: Array <OptionType> = []


    var selectedCustomerAddress: AddressType = {id: ''}

    if (currentUserInfo.addresses.length > 0) {
        // addressOptions.push({label: "Billing", value: "BILLING"})
        // addressOptions.push({label: "Address Full Text", value: "123 232"})

        currentUserInfo.addresses.map((address: AddressType) => {
            let addressLabel: string = ''
            if (address.type === 'SHIPPING') {
                addressLabel += address.address1 + ' ' + address.address2 
                addressLabel += ' ' + address.city + ' ' + address.state + ' ' + address.postcode 
                
                selectedCustomerAddress = address
                addressOptions.push({label: addressLabel, value: address.id})
            }
        })
    }

    const submitHandler = () => {
        console.log(selectedCustomerAddress.id)

        dispatch(setShippingAddressId(selectedCustomerAddress.id))
        
        // tmp hard coded value
        dispatch(setBillingAddressId('484db84a-ca20-472f-a196-8a0afb61ae43'))
        navigate('/checkout/shipping')
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
                                        <div>
                                            {JSON.stringify(currentUserInfo.addresses)}
                                        </div>
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
                                                Shipping Address
                                            </div>
                                            {(currentUserInfo.addresses.length > 0) ? 
                                                <>
                                                    Inside If
                                                    <FormSelect options={addressOptions} setOnChange={customerAddressOnChange} 
                                                        value={selectedCustomerAddress.id} />

                                                    {/* <div className='selected-address'>
                                                        <div>
                                                            {selectedCustomerAddress.first_name} {selectedCustomerAddress.last_name}
                                                        </div>
                                                    </div> */}
                                                </>
                                                : 
                                                <>
                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="first-name" labelText="First Name"/>
                                                        <FormInput id="first-name" value={firstName} type="text" setOnChange={firstNameOnChange}
                                                            placeholder="First Name"/>
                                                    </div>

                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="last-name" labelText="Last name"/>
                                                        <FormInput id="last-name" value={lastName}  type="text" setOnChange={lastNameOnChange}
                                                            placeholder="Last name"/>
                                                    </div>

                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="company-name" labelText="Company Name"/>
                                                        <FormInput id="company-name" value={companyName}  type="text" setOnChange={companyNameOnChange}
                                                            placeholder="Company Name"/>
                                                    </div>

                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="address1" labelText="Address1"/>
                                                        <FormInput id="address1" value={address1}  type="text" setOnChange={address1OnChange}
                                                            placeholder="Address1"/>
                                                    </div>


                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="address2" labelText="Address2"/>
                                                        <FormInput id="address2" value={address2}  type="text" setOnChange={address2OnChange}
                                                            placeholder="Address2"/>
                                                    </div>

                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="postcode" labelText="PostCode"/>
                                                        <FormInput id="postcode" value={postcode}  type="text" setOnChange={postcodeOnChange}
                                                            placeholder="PostCode"/>
                                                    </div>

                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="city" labelText="City"/>
                                                        <FormInput id="city" value={city}  type="text" setOnChange={cityOnChange}
                                                            placeholder="City"/>
                                                    </div>

                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="phone" labelText="Phone"/>
                                                        <FormInput id="phone" value={phone}  type="text" setOnChange={phoneOnChange}
                                                            placeholder="Phone"/>
                                                    </div>

                                                    <div className="space-y-1 rounded-md shadow-sm">
                                                        <FormLabel forId="country-id" labelText="Country"/>
                                                        <FormInput id="country-id" value={countryId}  type="text" setOnChange={countryIdOnChange}
                                                            placeholder="Country"/>
                                                    </div>
                                                </>
                                            } 
                                            
                                            
                                            


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
