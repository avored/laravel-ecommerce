import { PencilIcon } from '@heroicons/react/24/solid';
import React from 'react'
import { FormattedMessage } from 'react-intl';
import { Link } from 'react-router-dom';
import { useQuery } from 'urql';
import { useAppSelector } from '../../app/hooks';
import { Header } from '../../components/Header'
import { getAuthUserInfo } from '../../features/userLogin/userLoginSlice';
import { UserSidebar } from './UserSidebar'



export const UserAddresses = () => {

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
  const [{ fetching, data }] = useQuery({query: AddressesAllQuery});
  
  return (
    <div className="min-h-full">
      <Header />

      <header className="bg-white shadow">
        <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold tracking-tight text-gray-900">
            User Addresses
          </h1>
        </div>
      </header>
      <main>
        <div className="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
          <div className="px-4 py-6 sm:px-0">
              <div className='flex w-full'>
                <div className='w-64 border '>
                    <UserSidebar user={currentUserInfo} />
                </div>
                <div className='flex-1 ml-3'>
                {fetching === true ? (
                        <p>Loading</p>
                      ) : (
                        <>
                          <div className="border rounded">
                              <div className="p-3 border-b">
                                  <div className='flex w-full'>
                                    <div className='font-semibold'>
                                        <FormattedMessage id="user_addresses" />
                                    </div>
                                    <div className='ml-auto'>
                                        <Link
                                          to="/user/address/create"
                                          className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                        >
                                          <PencilIcon className="absolute w-6 h-6 opacity-40 left-0 flex items-center pl-3" />
                                            <span className='ml-3'>
                                              <FormattedMessage id="create" />
                                            </span>
                                        </Link>
                                    </div>
                                  </div>
                              </div>
                              <div className='p-3'>
                                Card Content
                              </div>
                          </div>
                          <h1>User Address List</h1>
                          {JSON.stringify(data)}
                        </>
                      )}
                </div>

              </div>
          </div>
        </div>
      </main>
    </div>
    )
}
