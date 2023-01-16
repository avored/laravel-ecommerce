import React from 'react'
import { useAppSelector } from '../../app/hooks';
import { Header } from '../../components/Header'
import { getAuthUserInfo } from '../../features/userLogin/userLoginSlice';
import { UserSidebar } from './UserSidebar'
import { AvoRedApp } from '../../components/Layout/AvoRedApp';

export const UserOrders = () => {
  const currentUserInfo = useAppSelector(getAuthUserInfo);
  return (
      <AvoRedApp>
        <header className="bg-white shadow">
          <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 className="text-3xl font-bold tracking-tight text-gray-900">
              User Orders
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
                    User Orders
                  </div>

                </div>
            </div>
          </div>
        </main>
      </AvoRedApp>
    )
}
