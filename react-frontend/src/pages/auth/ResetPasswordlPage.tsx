import React, { useEffect, useState } from "react";
import { useMutation } from "urql";
import Logo from "../../logo.svg";
import { LockOpenIcon } from "@heroicons/react/24/solid";
import { get, isEmpty } from "lodash";
import { useNavigate, useSearchParams } from "react-router-dom";
import { FormLabel } from "../../components/Form/FormLabel";
import { FormInput } from "../../components/Form/FormInput";
import { FormattedMessage, useIntl } from "react-intl";
import { AvoRedApp } from "../../components/Layout/AvoRedApp";
import { setMessage } from "../../features/flash/flashSlice";
import { useAppDispatch } from "../../app/hooks";
import { DebugGraphqlErrorMessage } from "../../components/DebugGraphqlErrorMessage";

const ResetPasswordMutation = `
    mutation ResetPasswordMutation (
        $email: String!
        $token: String!
        $password: String!
        $password_confirmation: String!
      ){
        resetPassword (
          email: $email
          token: $token
          password: $password
          password_confirmation: $password_confirmation
        ){
          success
          message
        }
    }
`;

export const ResetPasswordlPage = () => {
  const [searchParams, setSearchParams] = useSearchParams();
  const [debugMessage, setDebugMessage] = useState('');
  const [formValidation, setFormValidation] = useState({});
  const intl = useIntl();
  const navigate = useNavigate()
  const dispatch = useAppDispatch()
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [confirmPassword, setConfirmPassword] = useState('')
  const token = searchParams.get('token')


  useEffect(() => {
      document.title = "Reset Password";
  }, []);

  const [resetPasswordResult, resetPassword] = useMutation(
    ResetPasswordMutation
  );

  const emailOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEmail(e.target.value);
  };
  const passwordOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPassword(e.target.value)
  }
  const confirmPasswordOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setConfirmPassword(e.target.value)
  }


  const submitHandle = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const variables = { email, password, password_confirmation: confirmPassword, token };

    resetPassword(variables).then((mutationResult) => {
      if (!isEmpty(get(mutationResult, 'error.graphQLErrors.0.originalError.debugMessage'))) {
        setDebugMessage(get(mutationResult, 'error.graphQLErrors.0.originalError.debugMessage', ''))
        return
      }

      if (get(mutationResult, 'error.graphQLErrors.0.extensions.category') === 'validation') {
        setFormValidation(get(mutationResult, 'error.graphQLErrors.0.extensions.validation', ['']))
      }
      
      const resetInfo = get(mutationResult, 'data.resetPassword')
      if (!isEmpty(resetInfo)) {
        dispatch(setMessage('Your password has been updated successfully.'))
        navigate('/login')
      }
    });



  };
  return (
    <AvoRedApp>
      <main>
        <div className="flex justify-center mt-5">
          <div className="w-full shadow-md py-12 px-4 sm:px-6 lg:px-8  max-w-md space-y-8">
            <div>
              <img
                className="mx-auto h-12 w-auto"
                src={Logo}
                alt="AvoRed Ecommerce"
              />
              <h2 className="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                <FormattedMessage id="reset_password" />
              </h2>
            </div>
            <form
              className="mt-8 space-y-6"
              onSubmit={(e) => submitHandle(e)}
              action="#"
              method="POST"
            >
              <DebugGraphqlErrorMessage message={debugMessage} />
              <div className="space-y-1 rounded-md shadow-sm">
                <FormLabel
                  forId="email-address"
                  labelText={intl.formatMessage({ id: "email_address" })}
                />
                <FormInput
                  id="email-address"
                  value={email}
                  type="email"
                  setOnChange={emailOnChange}
                  errorMessages={get(formValidation, 'email', [])}
                  placeholder={intl.formatMessage({ id: "email_address" })}
                />
              </div>
              <div className="space-y-1 rounded-md shadow-sm">
                <FormLabel
                  forId="password"
                  labelText={intl.formatMessage({ id: "password" })}
                />
                <FormInput
                  id="password"
                  value={password}
                  type="password"
                  setOnChange={passwordOnChange}
                  errorMessages={get(formValidation, 'password', [])}
                  placeholder={intl.formatMessage({ id: "password" })}
                />
              </div>
              <div className="space-y-1 rounded-md shadow-sm">
                <FormLabel
                  forId="password_confirmation"
                  labelText={intl.formatMessage({ id: "password_confirmation" })}
                />
                <FormInput
                  id="password_confirmation"
                  value={confirmPassword}
                  type="password"
                  setOnChange={confirmPasswordOnChange}
                  placeholder={intl.formatMessage({ id: "password_confirmation" })}
                />
              </div>

              <div>
                <button
                  type="submit"
                  className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                >
                  <LockOpenIcon className="absolute w-7 h-7 opacity-40 inset-y-1 left-0 flex items-center pl-3" />
                  <FormattedMessage id="reset_password" />
                </button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </AvoRedApp>
  );
};
