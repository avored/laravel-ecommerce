import React, { useState } from "react";
import { useMutation } from "urql";
import Logo from "../../logo.svg";
import { LockClosedIcon } from '@heroicons/react/24/solid'
import { useAppSelector, useAppDispatch } from '../../app/hooks';
import {
  setAuthInfo,
  isAuth,
  getAuthUserInfo,
  setIsAuth
} from '../../features/userLogin/userLoginSlice';
import { first, get } from "lodash";
import { useNavigate } from "react-router-dom";
import { Header } from "../../components/Header";
import { FormLabel } from "../../components/Form/FormLabel";
import { FormInput } from "../../components/Form/FormInput";
import { Link } from "react-router-dom";
import { FormattedMessage, useIntl } from "react-intl";
import { AvoRedApp } from "../../components/Layout/AvoRedApp";


const RegisterMutationQuery = `
  mutation RegisterCustomer (
    $email: String!,
    $password: String!,
    $password_confirmation: String!,
    $first_name: String!,
    $last_name: String!
  ) {
    register(
        email: $email,
        password: $password,
        password_confirmation: $password_confirmation
        first_name: $first_name,
        last_name: $last_name
    )  {
        token_info {
            access_token
        }
    }
  }
`;


declare global {
  interface Window { x: any; }
}

export const RegisterPage = () => {

  const intl = useIntl();
  const currentUserInfo = useAppSelector(getAuthUserInfo);
  const isUserAuth = useAppSelector(isAuth)
  const navigate = useNavigate();


  const [registerMutationResult, registerMutation] = useMutation(RegisterMutationQuery)


  const dispatch = useAppDispatch();

  const [firstName, setFirstName] = useState('')
  const [lastName, setLastName] = useState('')
  const [email, setEmail] = useState('ind.purvesh@gmail.com')
  const [password, setPassword] = useState('admin123')
  const [confirmPassword, setConfirmPassword] = useState('admin123')

  const emailOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEmail(e.target.value)
  }
  const firstNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFirstName(e.target.value)
  }
  const lastNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setLastName(e.target.value)
  }
  const passwordOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPassword(e.target.value)
  }
  const confirmPasswordOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setConfirmPassword(e.target.value)
  }

  const submitHandle = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault()
    const variables = { email, password, password_confirmation: confirmPassword, first_name: firstName, last_name: lastName }

    console.log(variables)
    registerMutation(variables).then(({ data }) => {

      console.log(data)
      // const authInfo = get(data, 'login')
      // console.log(authInfo)
      // dispatch(setAuthInfo(authInfo))
      // dispatch(setIsAuth(true))
      // navigate('/user/profile')

      
    });
  }
  return (
    <AvoRedApp>
      <main>
        <div className="flex justify-center mt-5">
          <div className="w-full shadow-md py-12 px-4 sm:px-6 lg:px-8  max-w-md space-y-8">
            <div>
              {JSON.stringify(currentUserInfo)}
              <img
                className="mx-auto h-12 w-auto"
                src={Logo}
                alt="AvoRed Ecommerce"
              />
              <h2 className="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                <FormattedMessage id="register_for_avored_account" />
              </h2>

            </div>
            <form className="mt-8 space-y-6" onSubmit={(e) => submitHandle(e)} action="#" method="POST">
              <div className="space-y-1 rounded-md shadow-sm">
                <FormLabel forId="first_name" labelText={intl.formatMessage({ id: "first_name" })} />
                <FormInput id="first_name" value={firstName} type="text" setOnChange={firstNameOnChange} placeholder={intl.formatMessage({ id: "first_name" })} />
              </div>
              <div className="space-y-1 rounded-md shadow-sm">
                <FormLabel forId="last_name" labelText={intl.formatMessage({ id: "last_name" })} />
                <FormInput id="last_name" value={lastName} type="text" setOnChange={lastNameOnChange} placeholder={intl.formatMessage({ id: "last_name" })} />
              </div>

              <div className="space-y-1 rounded-md shadow-sm">
                <FormLabel forId="email_address" labelText={intl.formatMessage({ id: "email_address" })} />
                <FormInput id="email_address" value={email} type="email" setOnChange={emailOnChange} placeholder={intl.formatMessage({ id: "email_address" })} />
              </div>

              <div className="space-y-1 rounded-md shadow-sm">
                <FormLabel forId="password" labelText={intl.formatMessage({ id: "password" })} />
                <FormInput id="password" type="password" value={password} setOnChange={passwordOnChange} placeholder={intl.formatMessage({ id: "password" })} />
              </div>

              <div className="space-y-1 rounded-md shadow-sm">
                <FormLabel forId="confirm_password" labelText={intl.formatMessage({ id: "confirm_password" })} />
                <FormInput id="confirm_password" type="password" value={confirmPassword} setOnChange={confirmPasswordOnChange} placeholder={intl.formatMessage({ id: "confirm_password" })} />
              </div>

              <div className="flex">
                <div className="text-sm ml-auto">
                  <Link
                    to="/forgot-password"
                    className="font-medium text-red-600 hover:text-red-500"
                  >
                    Forgot your password?
                  </Link>
                </div>
              </div>

              <div>
                <button
                  type="submit"
                  className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                >
                  <LockClosedIcon className="absolute w-7 h-7 opacity-40 inset-y-1 left-0 flex items-center pl-3" />
                  Register
                </button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </AvoRedApp>
  );
};
