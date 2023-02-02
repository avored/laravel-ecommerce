import React from 'react'
import { FormattedMessage } from 'react-intl'
import { Link } from 'react-router-dom'
import { useAppSelector } from '../../app/hooks'
import { getAuthUserInfo } from '../../features/userLogin/userLoginSlice'
import { UserSidebar } from './UserSidebar'
import { AvoRedApp } from '../../components/Layout/AvoRedApp'

export const Profile = () => {

  const currentUserInfo = useAppSelector(getAuthUserInfo);

  return (
    <AvoRedApp>
      <header className="bg-white shadow">
        <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold tracking-tight text-gray-900">
            User Profile Page
          </h1>
        </div>
      </header>
      <main>
        <div className="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
          <div className="px-4 py-6 sm:px-0">
              <div className='flex w-full'>
                <div className='w-64 border '>
                    <UserSidebar user={currentUserInfo} />
                    <Link to="/login">Login Page</Link>
                </div>
                <div className='flex-1 ml-3'>
                  <div className='flex w-full'>
                    <div className='w-1/6 text-gray-700 text-right pr-5'>
                        <FormattedMessage id="first_name" />
                    </div>
                    <div className='w-5/6 font-semibold'>
                        {currentUserInfo.first_name}
                    </div>
                  </div>
                  <div className='flex w-full'>
                    <div className='w-1/6 text-gray-700 text-right pr-5'>
                        <FormattedMessage id="last_name" />
                    </div>
                    <div className='w-5/6 font-semibold'>
                        {currentUserInfo.last_name}
                    </div>
                  </div>
                  <div className='flex w-full'>
                    <div className='w-1/6 text-gray-700 text-right pr-5'>
                        <FormattedMessage id="email_address" />
                    </div>
                    <div className='w-5/6 font-semibold'>
                        {currentUserInfo.email}
                    </div>
                  </div>

                </div>
              </div>
          </div>
        </div>
      </main>
    </AvoRedApp>
    
    )
}
