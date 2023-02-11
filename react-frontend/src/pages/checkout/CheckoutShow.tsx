import { get } from "lodash";
import React, { useState } from "react";
import { getAuthUserInfo, setAuthInfo, setIsAuth } from "../../features/userLogin/userLoginSlice";
import { useMutation, useQuery } from "urql";
import { isEmpty } from "lodash";
import { useAppDispatch, useAppSelector } from "../../app/hooks";
import { FormInput } from "../../components/Form/FormInput";
import { FormLabel } from "../../components/Form/FormLabel";
import { visitorId } from "../../features/cart/cartSlice";
import { useNavigate } from "react-router-dom";
import { setCustomerId } from "../../features/checkout/checkoutSlice";
import { AvoRedApp } from "../../components/Layout/AvoRedApp";
import { DebugGraphqlErrorMessage } from "../../components/DebugGraphqlErrorMessage";
import { FormattedMessage, useIntl } from "react-intl";
import { setMessage } from "../../features/flash/flashSlice";

const GetCartItems = `
query CartItems($visitorId: String!)  {
  cartItems (visitor_id: $visitorId)  {
      visitor_id
      product_id
      product {
          name
          main_image_url
          price
      }
      qty
  }
}
`;

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

export const CheckoutShow = () => {
  const [debugMessage, setDebugMessage] = useState("");
  const [formValidation, setFormValidation] = useState({});
  const navigate = useNavigate();
  const dispatch = useAppDispatch();
  const intl = useIntl();

  const currentUserInfo = useAppSelector(getAuthUserInfo);
  if (!isEmpty(currentUserInfo.id)) {
    dispatch(setCustomerId(currentUserInfo.id));

    navigate("/checkout/shipping-address");
  }
  const [registerMutationResult, registerMutation] = useMutation(
    RegisterMutationQuery
  );

  const [email, setEmail] = useState("");
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [password, setPassword] = useState("");
  const [passwordComfirmation, setPasswordComfirmation] = useState("");

  const emailOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEmail(e.target.value);
  };
  const firstNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFirstName(e.target.value);
  };
  const lastNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setLastName(e.target.value);
  };

  const passwordOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPassword(e.target.value);
  };
  const passwordConfirmationOnChange = (
    e: React.ChangeEvent<HTMLInputElement>
  ) => {
    setPasswordComfirmation(e.target.value);
  };

  const submitHandler = () => {
    const variables = {
      email,
      password,
      password_confirmation: passwordComfirmation,
      first_name: firstName,
      last_name: lastName,
    };

    registerMutation(variables).then((mutationResult) => {
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

      const authInfo = get(mutationResult, 'data.register')
      dispatch(setAuthInfo(authInfo))
        dispatch(setIsAuth(true))
        dispatch(setMessage(intl.formatMessage({id: 'register_success_message'})))
        navigate("/checkout/shipping-address");
    });

    // console.log('Click Submit')
    // navigate('/checkout/shipping-address')
  };

  // var cartTotal: number = 0
  // var shippingCost: number = 10.00
  const incrementCartTotal = (itemPrice: number, itemQty: number) => {
    // cartTotal += (itemPrice * itemQty)
  };
  const currentVisitorId = useAppSelector(visitorId);
  const [{ fetching, data }] = useQuery({
    query: GetCartItems,
    variables: { visitorId: currentVisitorId },
  });
  return (
    <AvoRedApp>
      <div className="mx-auto max-w-7xl">
        {fetching == true ? (
          <p>Loading</p>
        ) : (
          <>
            <div className="flex  my-10">
              <div
                id="summary"
                className="w-1/2 px-3 py-5"
              >
                <div className="flex mt-10 mb-5">
                  <h3 className="font-semibold text-gray-600 text-xs uppercase w-2/5">
                    Product Details
                  </h3>
                  <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">
                    Quantity
                  </h3>
                  <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">
                    Price
                  </h3>
                  <h3 className="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">
                    Total
                  </h3>
                </div>
                {get(data, "cartItems", []).map((cartItem: any) => {
                  incrementCartTotal(
                    get(cartItem, "product.price"),
                    get(cartItem, "qty", 1)
                  );
                  return (
                    <div
                      key={get(cartItem, "product.id")}
                      className="flex items-center hover:bg-gray-100 py-5"
                    >
                      <div className="flex w-2/5">
                        <div className="w-20">
                          <img
                            className="h-24"
                            src={get(cartItem, "product.main_image_url")}
                            alt={get(cartItem, "product.name")}
                          />
                        </div>
                        <div className="flex flex-col justify-between ml-4 flex-grow">
                          <span className="font-bold text-sm">
                            {get(cartItem, "product.name")}
                          </span>
                          <div className="font-semibold hover:text-red-500 text-gray-500 text-xs">
                            Remove
                          </div>
                        </div>
                      </div>
                      <div className="flex justify-center w-1/5">
                        <input
                          name="qty"
                          type="text"
                          value={get(cartItem, "qty")}
                          className="mx-2 border text-center w-24 rounded border-gray-300 px-3 py-2 text-gray-900 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm"
                        />
                      </div>
                      <span className="text-center w-1/5 font-semibold text-sm">
                        ${get(cartItem, "product.price")}
                      </span>
                      <span className="text-center w-1/5 font-semibold text-sm">
                        ${get(cartItem, "product.price") * get(cartItem, "qty")}
                      </span>
                    </div>
                  );
                })}
              </div>
              <div
                id="order-info"
                className="w-1/2 px-3 py-5"
              >
                <div className="">
                  <div className="p-3 pl-0 font-semibold border-b ">
                        <FormattedMessage id="customer_information" />
                    </div>
                  <DebugGraphqlErrorMessage message={debugMessage} />

                  <div className="flex mt-5 w-full">
                    <div className="w-1/2">
                      <div className="space-y-1 rounded-md shadow-sm">
                        <FormLabel forId="first-name" labelText="First Name" />
                        <FormInput
                          value={firstName}
                          id="first-name"
                          type="text"
                          setOnChange={firstNameOnChange}
                          errorMessages={get(formValidation, "first_name", [])}
                          placeholder="First Name"
                        />
                      </div>
                    </div>
                    <div className="w-1/2 ml-3">
                      <div className="space-y-1 rounded-md shadow-sm">
                        <FormLabel forId="last-name" labelText="Last name" />
                        <FormInput
                          value={lastName}
                          id="last-name"
                          errorMessages={get(formValidation, "last_name", [])}
                          setOnChange={lastNameOnChange}
                          placeholder="Last name"
                        />
                      </div>
                    </div>
                  </div>

                  <div className="space-y-1 mt-3 rounded-md shadow-sm">
                    <FormLabel
                      forId="email-address"
                      labelText="Email address"
                    />
                    <FormInput
                      value={email}
                      id="email-address"
                      type="email"
                      setOnChange={emailOnChange}
                      errorMessages={get(formValidation, "email", [])}
                      placeholder="Email address"
                    />
                  </div>
                  <div className="flex mt-3 w-full">
                    <div className="w-1/2">
                      <div className="space-y-1 rounded-md shadow-sm">
                        <FormLabel forId="password" labelText="Password" />
                        <FormInput
                          value={password}
                          id="password"
                          type="password"
                          errorMessages={get(formValidation, "password", [])}
                          setOnChange={passwordOnChange}
                          placeholder="Password"
                        />
                      </div>
                    </div>
                    <div className="w-1/2 ml-3">
                      <div className="space-y-1 rounded-md shadow-sm">
                        <FormLabel
                          forId="conform-password"
                          labelText="Confirm Password"
                        />
                        <FormInput
                          value={passwordComfirmation}
                          id="conform-password"
                          errorMessages={get(
                            formValidation,
                            "password_confirmation",
                            []
                          )}
                          type="password"
                          setOnChange={passwordConfirmationOnChange}
                          placeholder="Confirm Password"
                        />
                      </div>

                    </div>
                  </div>
                <button
                    onClick={submitHandler}
                    className="bg-red-500 mt-5 rounded font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full"
                >
                    <FormattedMessage id="continue" />
                </button>
                </div>
              </div>
            </div>
            
          </>
        )}
      </div>
    </AvoRedApp>
  );
};
