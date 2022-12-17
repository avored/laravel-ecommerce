import React, { useEffect } from 'react'
import { useNavigate } from 'react-router-dom'

export const UserLogout = () => {

  const navigate = useNavigate();

  useEffect(() => {
    console.log('i am here')
      navigate("/login");
  }, []);


  return (<></>)
}
