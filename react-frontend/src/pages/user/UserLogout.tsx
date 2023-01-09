import React, { useEffect } from 'react'
import { useNavigate } from 'react-router-dom'
import { useAppDispatch } from '../../app/hooks';
import { performUserLogout } from '../../features/userLogin/userLoginSlice';

export const UserLogout = () => {

  const navigate = useNavigate();
  const dispatch = useAppDispatch();

  useEffect(() => {
      dispatch(performUserLogout(true))
      navigate("/login");
  }, []);


  return (<></>)
}
