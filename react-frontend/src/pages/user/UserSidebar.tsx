

import React from 'react'
import { Link } from 'react-router-dom'

export const UserSidebar = () => {
  return (
    <div className='text-center'>
        <img src='https://via.placeholder.com/250x250' className='object-cover' />
        <div className='mt-3'>
        <Link to="/user/edit-profile">Edit Profile</Link>
        </div>
        <div className='mt-3'>
        <Link to="/user/orders">Orders</Link>
        </div>
        <div className='mt-3'>
        <Link to="/user/addresses">Addresses</Link>
        </div>
        
        <div className='mt-3'>
        <Link to="/logout">Logout</Link>
        </div>
    </div>
  )
}
