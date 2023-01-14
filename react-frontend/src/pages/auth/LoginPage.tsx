import React, { useEffect, useState } from "react";
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
import { get } from "lodash";
import { useNavigate } from "react-router-dom";
import { Header } from "../../components/Header";
import { FormLabel } from "../../components/Form/FormLabel";
import { FormInput } from "../../components/Form/FormInput";
import { Link } from "react-router-dom";
import { FormattedMessage, useIntl } from "react-intl";
import { FormLink } from "../../components/Form/FormLink";
import { FormButton } from "../../components/Form/FormButton";


const CustomerLogin = `
    mutation CustomerLogin (
      $password: String!
      $email: String
    ) {
    login (
      email: $email
      password: $password
    ) {
      first_name
        last_name
        email
        image_path_url
        id
        created_at
        updated_at
        addresses {
            id
            type
            customer_id
            first_name
            last_name
            company_name
            address1
            address2
            postcode
            city
            state
            country_id
            phone
            created_at
            updated_at
        }
        token_info {
            token_type
            access_token
            expires_in
            refresh_token
        }
      }
    }
`;


declare global {
  interface Window { x: any; }
}

export const LoginPage = () => {

  const currentUserInfo = useAppSelector(getAuthUserInfo);
  const isUserAuth = useAppSelector(isAuth)
  const navigate = useNavigate();
  const intl = useIntl()


  const [customerLoginResult, customerLogin] = useMutation(CustomerLogin)

  const dispatch = useAppDispatch();

  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')

  const emailOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEmail(e.target.value)
  }
  const passwordOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPassword(e.target.value)
  }

  useEffect(() => {
      document.title = 'Login into your avored account';
  }, []);

  const submitHandle = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault()
    const variables = { email, password }
    customerLogin(variables).then(({ data }) => {
      const authInfo = get(data, 'login')
      dispatch(setAuthInfo(authInfo))
      dispatch(setIsAuth(true))
      navigate('/user/profile')
    });
  }
  return (

    <div className="antialiased">
      <Header />
      <main>
        <div className="flex justify-center mt-5">
          <div className="w-full shadow-md py-12 px-4 sm:px-6 lg:px-8  max-w-md mt-5 space-y-8">
              <img
                className="mx-auto h-12 w-auto"
                src={Logo}
                alt={intl.formatMessage({id: "avored_ecommerce_title"})}
              />
              <h2 className="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                  <FormattedMessage id="sign_into_your_account" />
              </h2>

              <form className="mt-8 space-y-6" onSubmit={(e) => submitHandle(e)} action="#" method="POST">
                <div className="space-y-1 rounded-md shadow-sm">
                  <FormLabel 
                      forId="email-address"
                      labelText={intl.formatMessage({id: "email_address"})}
                    />
                  <FormInput 
                      autofocus={true} 
                      id="email-address" 
                      value={email} 
                      type="email" 
                      setOnChange={emailOnChange} 
                      placeholder={intl.formatMessage({id: "email_address"})}
                    />
                </div>
                
                <div className="space-y-1 rounded-md shadow-sm">
                  <FormLabel
                      forId="password"
                      labelText={intl.formatMessage({id: "password"})}
                    />
                  <FormInput
                      id="password"
                      type="password"
                      value={password}
                      setOnChange={passwordOnChange}
                      placeholder={intl.formatMessage({id: "password"})}
                    />

                </div>

                <div className="flex">
                  <div className="text-sm ml-auto">
                      <FormLink path="/forgot-password">
                          <FormattedMessage id="forgot_your_password" />
                      </FormLink>
                  </div>
                </div>

                <div>
                    <FormButton type="submit">
                      <LockClosedIcon className="absolute w-7 h-7 opacity-40 inset-y-1 left-0 flex items-center pl-3" />
                      Sign in
                    </FormButton>
                  {/* <button
                    type="submit"
                    className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 focus:ring-offset-1"
                  >
                    
                  </button> */}
                </div>
              </form>
          </div>
        </div>
      </main>
    </div>
  );
};
