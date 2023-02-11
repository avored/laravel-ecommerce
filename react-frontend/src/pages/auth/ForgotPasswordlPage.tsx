import React, { useEffect, useState } from "react";
import { useMutation } from "urql";
import Logo from "../../logo.svg";
import { LockOpenIcon } from "@heroicons/react/24/solid";
import { get, isEmpty } from "lodash";
import { useNavigate } from "react-router-dom";
import { FormLabel } from "../../components/Form/FormLabel";
import { FormInput } from "../../components/Form/FormInput";
import { FormattedMessage, useIntl } from "react-intl";
import { AvoRedApp } from "../../components/Layout/AvoRedApp";
import { setMessage } from "../../features/flash/flashSlice";
import { useAppDispatch } from "../../app/hooks";
import { DebugGraphqlErrorMessage } from "../../components/DebugGraphqlErrorMessage";

const ForgotPasswordMutation = `
mutation ForgotPasswordMutation ($email: String!) {
    forgotPassword (email: $email) {
      success
      message
    }
  }
`;

export const ForgotPasswordlPage = () => {
  const [debugMessage, setDebugMessage] = useState("");
  const [formValidation, setFormValidation] = useState({});
  const intl = useIntl();
  const navigate = useNavigate();
  const dispatch = useAppDispatch();

  useEffect(() => {
    document.title = "Forgot your password";
  }, []);

  const [forgotPasswordResult, forgotPassword] = useMutation(
    ForgotPasswordMutation
  );

  console.log(forgotPasswordResult);
  const [email, setEmail] = useState("");

  const emailOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEmail(e.target.value);
  };

  const submitHandle = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const variables = { email };

    forgotPassword(variables).then((mutationResult) => {
      if (
        !isEmpty(
          get(
            mutationResult,
            "error.graphQLErrors.0.originalError.debugMessage"
          )
        )
      ) {
        setDebugMessage(
          get(
            mutationResult,
            "error.graphQLErrors.0.originalError.debugMessage",
            ""
          )
        );
        return;
      }

      if (
        get(mutationResult, "error.graphQLErrors.0.extensions.category") ===
        "validation"
      ) {
        setFormValidation(
          get(mutationResult, "error.graphQLErrors.0.extensions.validation", [
            "",
          ])
        );
      }

      dispatch(
        setMessage(
          "You will received an email in regards with reseting your password soon."
        )
      );
      navigate("/login");
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
                <FormattedMessage id="forgot_your_password" />
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
                  errorMessages={get(formValidation, "email", [])}
                  setOnChange={emailOnChange}
                  placeholder={intl.formatMessage({ id: "email_address" })}
                />
              </div>

              <div>
                <button
                  type="submit"
                  className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                >
                  <LockOpenIcon className="absolute w-7 h-7 opacity-40 inset-y-1 left-0 flex items-center pl-3" />
                  <FormattedMessage id="sent_reset_password_link" />
                </button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </AvoRedApp>
  );
};
