import React from 'react'
import { Link } from 'react-router-dom'
import { Header } from '../../components/Header'
import { UserSidebar } from './UserSidebar'

export const UserOrders = () => {
  return (
    <div className="min-h-full">
      <Header />

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
                <UserSidebar />
                </div>
                <div className='flex-1 ml-3'>
                   User Orders
                </div>

              </div>
          </div>
        </div>
      </main>
    </div>
    )
}
