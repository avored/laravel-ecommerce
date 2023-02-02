import React, { useEffect, useState } from "react";
import { useMutation } from "urql";
import Logo from "../../logo.svg";
import { LockClosedIcon } from '@heroicons/react/24/solid'
import { useAppSelector, useAppDispatch } from '../../app/hooks';
import { loader } from 'graphql.macro'
import {
  setAuthInfo,
  isAuth,
  getAuthUserInfo,
  setIsAuth
} from '../../features/userLogin/userLoginSlice';
import { get, isEmpty } from "lodash";
import { useNavigate } from "react-router-dom";
import { Header } from "../../components/Header";
import { FormLabel } from "../../components/Form/FormLabel";
import { FormInput } from "../../components/Form/FormInput";
import { FormattedMessage, useIntl } from "react-intl";
import { FormLink } from "../../components/Form/FormLink";
import { FormButton } from "../../components/Form/FormButton";
import { AvoRedApp } from "../../components/Layout/AvoRedApp";
import { setMessage } from "../../features/flash/flashSlice";
import { DebugGraphqlErrorMessage } from "../../components/DebugGraphqlErrorMessage";
declare global {
  interface Window { x: any; }
}

export const LoginPage = () => {

  const [debugMessage, setDebugMessage] = useState('');
  const [formValidation, setFormValidation] = useState({});
  const currentUserInfo = useAppSelector(getAuthUserInfo);
  const isUserAuth = useAppSelector(isAuth)
  const navigate = useNavigate();
  const intl = useIntl()

  const CustomerLoginQuery = loader('../../graphql/mutation/auth/Login.graphql')
  const [customerLoginResult, customerLogin] = useMutation(CustomerLoginQuery)

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
    customerLogin(variables).then((mutationResult) => {

      if (!isEmpty(get(mutationResult, 'error.graphQLErrors[0].originalError.debugMessage'))) {
        setDebugMessage(get(mutationResult, 'error.graphQLErrors[0].originalError.debugMessage', ''))
        return
      }

      if (!isEmpty(get(mutationResult, 'error.graphQLErrors.0.extensions.validation'))) {
        setFormValidation(get(mutationResult, 'error.graphQLErrors.0.extensions.validation', {}))
      }


      
      const authInfo = get(mutationResult, 'data.login')
      if (!isEmpty(authInfo)) {
        dispatch(setAuthInfo(authInfo))
        dispatch(setIsAuth(true))
        dispatch(setMessage('You successfuly logged into your avored account'))
        navigate('/user/profile')
      }
    });
  }
  return (
    <AvoRedApp>
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
                  
                  <DebugGraphqlErrorMessage message={debugMessage} />

                  <div className="space-y-1 rounded-md">
                    <FormLabel 
                        forId="email-address"
                        labelText={intl.formatMessage({id: "email_address"})}
                      />
                    <FormInput 
                        autofocus={true} 
                        id="email-address" 
                        value={email} 
                        errorMessages={get(formValidation, 'email', [])}
                        type="text" 
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
                        <FormattedMessage id="sign_in" />
                      </FormButton>
                  </div>
                </form>
            </div>
          </div>
        </main>
    </AvoRedApp>
  );
};
