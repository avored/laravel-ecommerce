import { LockClosedIcon } from '@heroicons/react/24/solid';
import { get } from 'lodash';
import React, { useState } from 'react'
import { FormattedMessage, useIntl } from 'react-intl';
import { useNavigate, useParams } from 'react-router-dom';
import { useMutation, useQuery } from 'urql';
import { useAppSelector } from '../../app/hooks';
import { FormInput } from '../../components/Form/FormInput';
import { FormLabel } from '../../components/Form/FormLabel';
import FormSelect, { OptionType } from '../../components/Form/FormSelect';
import { Header } from '../../components/Header'
import { getAuthUserInfo } from '../../features/userLogin/userLoginSlice';
import { UserSidebar } from './UserSidebar'

export const EditAddress = () => {
  var { addressId } = useParams();


  const GetAddress = `
      query ($addressId : String!) {
        addressQuery  (id: $addressId) {
                id
                type
                first_name
                last_name
                company_name
                phone
                address1
                address2
                state
                city
                postcode
                country_id
                created_at
                updated_at
        }
    }
  `;

  const [{ fetching, data }] = useQuery({ query: GetAddress, variables: { addressId } });

  const addressEdit = `
    mutation UpdateAddressMutation (
        $addressId : String!
        $type : String!
        $firstName: String!
        $lastName: String!
        $companyName: String
        $address1: String!
        $address2: String!
        $phone: String
        $city: String!
        $state: String!
        $postcode: String!
        $countryId: String!
    ) {
          updateAddress (
              id: $addressId    
              type: $type    
              first_name:$firstName
              last_name: $lastName
              company_name: $companyName
              phone: $phone
              address1: $address1
              address2: $address2
              postcode: $postcode
              city: $city
              state: $state
              country_id: $countryId
        ) {
    
            id
            customer_id
            type
        }
    }
  `
  const intl = useIntl();
  const currentUserInfo = useAppSelector(getAuthUserInfo);
  const [addressEditResult, addressEditMutation] = useMutation(addressEdit);

  const navigate = useNavigate()

  const types: Array <OptionType> = [{label: "Shipping", value: "SHIPPING"}, {label: "Billing", value: "BILLING"}]
  
  const [type, setType] = useState(get(data, 'addressQuery.type'))
  const [firstName, setFirstName] = useState(get(data, 'addressQuery.first_name'))
  const [lastName, setLastName] = useState(get(data, 'addressQuery.last_name'))
  const [companyName, setCompanyName] = useState(get(data, 'addressQuery.company_name'))
  const [phone, setPhone] = useState(get(data, 'addressQuery.phone'))
  const [countryId, setCountryId] = useState(get(data, 'addressQuery.country_id'))
  const [postcode, setPostcode] = useState(get(data, 'addressQuery.postcode'))
  const [address1, setAddress1] = useState(get(data, 'addressQuery.address1'))
  const [address2, setAddress2] = useState(get(data, 'addressQuery.address2'))
  const [state, setState] = useState(get(data, 'addressQuery.state'))
  const [city, setCity] = useState(get(data, 'addressQuery.city'))

  const typeOnChange = (type: string) : void => {
    setType(type)
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
  const phoneOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPhone(e.target.value)
  }
  const countryIdOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setCountryId(e.target.value)
  }
  const postcodeOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPostcode(e.target.value)
  }
  const address1OnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setAddress1(e.target.value)
  }
  const address2OnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setAddress2(e.target.value)
  }
  const stateOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setState(e.target.value)
  }
  const cityOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setCity(e.target.value)
  }

  const submitHandle = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault()
    const variables = { addressId, firstName, lastName, companyName, phone, address1, address2, countryId, postcode, state, city, type }
    await addressEditMutation(variables)

    if (get(addressEditResult, 'data.updateAddress.id')) {
        navigate('/user/addresses')
    }
   
  }

  return (
    <div className="min-h-full">
      <Header />

      <header className="bg-white shadow">
        <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold tracking-tight text-gray-900">
              <FormattedMessage id="user_address_create" />
          </h1>
        </div>
      </header>
      {fetching === true ? (
          <p>Loading</p>
      ) : (
        <>
          <main>
            <div className="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
              <div className="px-4 py-6 sm:px-0">
                  <div className='flex w-full'>
                    <div className='w-64 border '>
                      <UserSidebar user={currentUserInfo} />
                    </div>
                    <div className='flex-1 ml-3'>
                      <div className="border rounded">
                        <div className="p-3 border-b">
                            <div className='flex w-full'>
                              <div className='font-semibold'>
                                  <FormattedMessage id="user_address_create" />
                              </div>
                            </div>
                        </div>
                        <div className='p-3'>
                        <form className="mt-8 space-y-6" onSubmit={(e) => submitHandle(e)} action="#" method="POST">
                            
                            <div className='flex w-full'>
                                <FormSelect options={types} setOnChange={typeOnChange} value="BILLING" />
                            </div>
                            <div className='flex w-full'>
                                <div className='w-1/2'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="first_name" labelText={intl.formatMessage({id: 'first_name'})} />
                                  <FormInput id="first_name" value={firstName} 
                                    type="text" setOnChange={firstNameOnChange} 
                                    placeholder={intl.formatMessage({id: 'first_name'})} />
                                </div> 
                                </div>
                                <div className='w-1/2 ml-3'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="last_name" labelText={intl.formatMessage({id: 'last_name'})} />
                                  <FormInput id="last_name" type="text" value={lastName} setOnChange={lastNameOnChange} placeholder={intl.formatMessage({id: 'last_name'})} />
                                </div> 
                                </div>
                            </div>

                            <div className='flex w-full'>
                                <div className='w-1/2'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="country_id" labelText={intl.formatMessage({id: 'country_id'})} />
                                  <FormInput id="country_id" value={countryId} 
                                    type="text" setOnChange={countryIdOnChange} 
                                    placeholder={intl.formatMessage({id: 'country_id'})} />
                                </div> 
                                </div>
                                <div className='w-1/2 ml-3'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="postcode" labelText={intl.formatMessage({id: 'postcode'})} />
                                  <FormInput id="postcode" type="text" value={postcode} setOnChange={postcodeOnChange} placeholder={intl.formatMessage({id: 'postcode'})} />
                                </div> 
                                </div>
                            </div>


                            <div className='flex w-full'>
                                <div className='w-1/2'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="address1" labelText={intl.formatMessage({id: 'address1'})} />
                                  <FormInput id="address1" value={address1} 
                                    type="text" setOnChange={address1OnChange} 
                                    placeholder={intl.formatMessage({id: 'address1'})} />
                                </div> 
                                </div>
                                <div className='w-1/2 ml-3'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="address2" labelText={intl.formatMessage({id: 'address2'})} />
                                  <FormInput id="address2" type="text" value={address2} setOnChange={address2OnChange} placeholder={intl.formatMessage({id: 'address2'})} />
                                </div> 
                                </div>
                            </div>
                            <div className='flex w-full'>
                                <div className='w-1/2'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="state" labelText={intl.formatMessage({id: 'state'})} />
                                  <FormInput id="state" value={state} 
                                    type="text" setOnChange={stateOnChange} 
                                    placeholder={intl.formatMessage({id: 'state'})} />
                                </div> 
                                </div>
                                <div className='w-1/2 ml-3'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="city" labelText={intl.formatMessage({id: 'city'})} />
                                  <FormInput id="city" type="text" value={city} setOnChange={cityOnChange} placeholder={intl.formatMessage({id: 'city'})} />
                                </div> 
                                </div>
                            </div>
                            <div className='flex w-full'>
                                <div className='w-1/2'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="company_name" labelText={intl.formatMessage({id: 'company_name'})} />
                                  <FormInput id="company_name" value={companyName} 
                                    type="text" setOnChange={companyNameOnChange} 
                                    placeholder={intl.formatMessage({id: 'company_name'})} />
                                </div> 
                                </div>
                                <div className='w-1/2 ml-3'>
                                <div className="space-y-1 rounded-md shadow-sm">
                                  <FormLabel forId="phone" labelText={intl.formatMessage({id: 'phone'})} />
                                  <FormInput id="phone" type="text" value={phone} setOnChange={phoneOnChange} placeholder={intl.formatMessage({id: 'phone'})} />
                                </div> 
                                </div>
                            </div>
                            
                            <div>
                              <button
                                type="submit"
                                className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                              >
                                <LockClosedIcon className="absolute w-7 h-7 opacity-40 inset-y-1 left-0 flex items-center pl-3" />
                                Save
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  </div>
              </div>
            </div>
          </main>
        </>
      )}
    </div>
    )
}
