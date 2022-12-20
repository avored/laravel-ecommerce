import React, { Fragment, useState } from "react";
import { useMutation } from "urql";
import Logo from "../../logo.svg";
import { LockOpenIcon } from "@heroicons/react/24/solid";
import { get } from "lodash";
import { useNavigate } from "react-router-dom";
import { Header } from "../../components/Header";
import { FormLabel } from "../../components/Form/FormLabel";
import { FormInput } from "../../components/Form/FormInput";
import { FormattedMessage, useIntl } from "react-intl";
import { Dialog, Transition } from "@headlessui/react";

const ForgotPasswordMutation = `
mutation ForgotPasswordMutation ($email: String!) {
    forgotPassword (email: $email) {
      success
      message
    }
  }
`;

export const ForgotPasswordlPage = () => {
  const intl = useIntl();
  const navigate = useNavigate();
  const [isOpen, setIsOpen] = useState(false)

  const [forgotPasswordResult, forgotPassword] = useMutation(
    ForgotPasswordMutation
  );
  const [email, setEmail] = useState("");

  const emailOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEmail(e.target.value);
  };
  function closeModal() {
    setIsOpen(false)
    navigate('/')
  }

  function openModal() {
    setIsOpen(true)
  }

  const submitHandle = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const variables = { email };
    await forgotPassword(variables);

    (get(forgotPasswordResult, 'data.forgotPassword.success')) ?? openModal()
  };
  return (
    <div className="min-h-full">
      <Transition appear show={isOpen} as={Fragment}>
        <Dialog as="div" className="relative z-10" onClose={closeModal}>
          <Transition.Child
            as={Fragment}
            enter="ease-out duration-300"
            enterFrom="opacity-0"
            enterTo="opacity-100"
            leave="ease-in duration-200"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
          >
            <div className="fixed inset-0 bg-black bg-opacity-25" />
          </Transition.Child>

          <div className="fixed inset-0 overflow-y-auto">
            <div className="flex min-h-full items-center justify-center p-4 text-center">
              <Transition.Child
                as={Fragment}
                enter="ease-out duration-300"
                enterFrom="opacity-0 scale-95"
                enterTo="opacity-100 scale-100"
                leave="ease-in duration-200"
                leaveFrom="opacity-100 scale-100"
                leaveTo="opacity-0 scale-95"
              >
                <Dialog.Panel className="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                  <Dialog.Title
                    as="h3"
                    className="text-lg font-medium leading-6 text-gray-900"
                  >
                    <FormattedMessage id="reset_password" />
                  </Dialog.Title>
                  <div className="mt-2">
                    <p className="text-sm text-gray-500">
                      Your reset password email has been sent successfully.
                      Please check your email and follow link to reset your password.
                    </p>
                  </div>

                  <div className="mt-4">
                    <button
                      type="button"
                      className="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                      onClick={closeModal}
                    >
                      Close
                    </button>
                  </div>
                </Dialog.Panel>
              </Transition.Child>
            </div>
          </div>
        </Dialog>
      </Transition>
      
      <Header />
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
                  placeholder={intl.formatMessage({ id: "email_address" })}
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
    </div>
  );
};
