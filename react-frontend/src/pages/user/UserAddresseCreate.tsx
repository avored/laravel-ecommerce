import { LockClosedIcon } from '@heroicons/react/24/solid';
import React, { useState } from 'react'
import { FormattedMessage } from 'react-intl';
import { useAppSelector } from '../../app/hooks';
import { FormInput } from '../../components/Form/FormInput';
import { FormLabel } from '../../components/Form/FormLabel';
import { Header } from '../../components/Header'
import { getAuthUserInfo } from '../../features/userLogin/userLoginSlice';
import { UserSidebar } from './UserSidebar'

export const UserAddresseCreate = () => {

  const currentUserInfo = useAppSelector(getAuthUserInfo);


  const [firstName, setFirstName] = useState('')
  const [lastName, setLastName] = useState('')

  const firstNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFirstName(e.target.value)
  }
  const lastNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setLastName(e.target.value)
  }

  const submitHandle = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault()
    const variables = { firstName, lastName }
    // customerLogin(variables).then(({ data }) => {
    //   const authInfo = get(data, 'login')
    //   console.log(authInfo)
    //   dispatch(setAuthInfo(authInfo))
    //   dispatch(setIsAuth(true))
    //   navigate('/user/profile')
    // });
  }

  return (
    <div className="min-h-full">
      <Header />

      <header className="bg-white shadow">
        <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold tracking-tight text-gray-900">
            User Addresss Create
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
                            <div className='w-1/2 border'>
                                 Test 
                            </div>
                            <div className='w-1/2 ml-3 border'>
                                 Test 2 
                            </div>
                        </div>
                        <div className="space-y-1 rounded-md shadow-sm">
                          <FormLabel forId="first_name" labelText="First Name" />
                          <FormInput id="first_name" value={firstName} 
                            type="text" setOnChange={firstNameOnChange} 
                            placeholder="Email address" />
                        </div>
                        <div className="space-y-1 rounded-md shadow-sm">
                          <FormLabel forId="last_name" labelText="Last Name" />
                          <FormInput id="last_name" type="text" value={lastName} setOnChange={lastNameOnChange} placeholder="Last Name" />
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
    </div>
    )
}
