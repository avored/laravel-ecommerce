import React, { useState } from "react";
import { useMutation } from "urql";
import Logo from "../../logo.svg";
import { LockClosedIcon } from '@heroicons/react/24/solid'
import { useAppSelector, useAppDispatch } from '../../app/hooks';
import {
  setAccessToken,
  accessToken,
  setAuth,
  isAuth
} from '../../features/userLogin/userLoginSlice';
import { get } from "lodash";
import { useNavigate } from "react-router-dom";


const CustomerLogin = `
    mutation CustomerLogin (
      $password: String!
      $email: String
    ) {
    login (
      email: $email
      password: $password
    ) {
      token_type
      access_token
      expires_in
      refresh_token
    }
    }
`;

// interface LoginResponse {
//   token: string;
//   expire_in: number;
//   refresh_token: string;
//   token_type: string
// }

export const LoginPage = () => {

  const currentAccessToken = useAppSelector(accessToken);
  const isUserAuth = useAppSelector(isAuth)
  const navigate = useNavigate();


  const [customerLoginResult, customerLogin] = useMutation(CustomerLogin)
  const dispatch = useAppDispatch();

  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')

  const handleChange = (event: React.ChangeEvent<HTMLInputElement>, type: string) => {
    switch(type) {
        case 'email': {
          setEmail(event.target.value)
          break;
        }
        case 'password': {
          setPassword(event.target.value)
          break;
        }
        default: {
          console.log(`The provided ${type}  handle change type event is not supported in auth/login page`)
          break;
        } 
    }
  }

  const submitHandle = () => {
      const variables = { email, password }
      // const variables = { id, title: newTitle || '' };
      // dispatch(performLoginAsync(variables))
      // console.log('button pressed')
      customerLogin(variables).then(({data}) => {
          const access_token = get(data, 'login.access_token')
          dispatch(setAccessToken(access_token))
          dispatch(setAuth(true))
          navigate('/user')
      });
  }
  return (
    <div className="flex min-h-screen items-center justify-center">
      <div className="w-full shadow-md py-12 px-4 sm:px-6 lg:px-8  max-w-md space-y-8">
        <div>
          {currentAccessToken}
          <img
            className="mx-auto h-12 w-auto"
            src={Logo}
            alt="AvoRed Ecommerce"
          />
          <h2 className="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
            Sign in to your account
          </h2>
          
        </div>
        <form className="mt-8 space-y-6" action="#" method="POST">
          <div className="space-y-2 rounded-md shadow-sm">
              <label htmlFor="email-address" className="text-gray-500 pl-1">
                Email address
              </label>
              <input
                id="email-address"
                name="email"
                onChange={e => handleChange(e, 'email')}
                type="email"
                value={email}
                className="block w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm"
                placeholder="Email address"
              />
          </div>

          <div className="space-y-2 rounded-md shadow-sm">
            <label htmlFor="password" className="text-gray-500 pl-1">
              Password
            </label>
            <input
              id="password"
              name="password"
              onChange={e => handleChange(e, 'password')}
              value={password}
              type="password"
              className="block w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm"
              placeholder="Password"
            />
          </div>

          <div className="flex">
            <div className="text-sm ml-auto">
              <a
                href="#"
                className="font-medium text-red-600 hover:text-red-500"
              >
                Forgot your password?
              </a>
            </div>
          </div>

          <div>
            <button
              type="button"
              onClick={submitHandle}
              className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
            >
              <LockClosedIcon className="absolute w-7 h-7 opacity-40 inset-y-1 left-0 flex items-center pl-3" />
              Sign in
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};
