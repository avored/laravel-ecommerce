import { PencilIcon } from "@heroicons/react/24/solid";
import { get } from "lodash";
import React from "react";
import { FormattedMessage } from "react-intl";
import { Link } from "react-router-dom";
import { useQuery } from "urql";
import { useAppSelector } from "../../app/hooks";
import { Header } from "../../components/Header";
import { Card } from "../../components/Layout/Card";
import { CardContent } from "../../components/Layout/CardContent";
import { CardTitle } from "../../components/Layout/CardTitle";
import { getAuthUserInfo } from "../../features/userLogin/userLoginSlice";
import { UserSidebar } from "./UserSidebar";
import { AvoRedApp } from "../../components/Layout/AvoRedApp";

export interface Address {
  id: string;
  type: string;
  address1: string;
  address2: string;
  first_name: string;
  last_name: string;
  phone: string;
  company_name: string;
  city: string;
  state: string;
  country_id: string;
  postcode: string;
}

export const UserAddresses = () => {
  const currentUserInfo = useAppSelector(getAuthUserInfo);

  const AddressesAllQuery = `
      query AddressAllQuery{
          allAddress {
              id
              type
              first_name
              last_name
              company_name
              phone
              address1
              address2
              city
              state
              postcode
              country_id
              created_at
              updated_at
          }
      }
    `;
  const [{ fetching, data }] = useQuery({ query: AddressesAllQuery });

  return (
    <AvoRedApp>
      <header className="bg-white shadow">
        <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold tracking-tight text-gray-900">
            User Addresses
          </h1>
        </div>
      </header>
      <main>
        <div className="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
          <div className="px-4 py-6 sm:px-0">
            <div className="flex w-full">
              <div className="w-64 border ">
                <UserSidebar user={currentUserInfo} />
              </div>
              <div className="flex-1 ml-3">
                {fetching === true ? (
                  <p>Loading</p>
                ) : (
                  <>
                    <Card>
                      <CardTitle>
                        <div className="font-semibold">
                          <FormattedMessage id="user_addresses" />
                        </div>
                        <div className="ml-auto">
                          <Link
                            to="/user/address/create"
                            className="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                          >
                            <PencilIcon className="absolute w-6 h-6 opacity-40 left-0 flex items-center pl-3" />
                            <span className="ml-3">
                              <FormattedMessage id="create" />
                            </span>
                          </Link>
                        </div>
                      </CardTitle>
                      <CardContent>
                        {get(data, "allAddress", []).map((address: Address) => {
                          return (
                            <div className="mt-5" key={address.id}>
                              <Card>
                                <CardTitle>
                                  <div className="font-semibold">
                                    {address.type}
                                  </div>
                                  <div className="ml-auto">
                                    <Link
                                      to={`/user/edit-address/${address.id}`}
                                      className="flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                    >
                                      <PencilIcon className="w-6 h-6" />
                                    </Link>
                                  </div>
                                </CardTitle>
                                <CardContent>
                                  <div className="overflow-hidden bg-white shadow sm:rounded-lg">
                                    <div className="px-4 py-5 sm:px-6">
                                      <h3 className="text-lg font-medium leading-6 text-gray-900">
                                          {address.type}
                                      </h3>
                                      
                                    </div>
                                    <div className="border-t border-gray-200">
                                     
                                        <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="first_name" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.first_name}
                                          </div>
                                        </div>
                                        <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="company_name" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.company_name}
                                          </div>
                                        </div>
                                        <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="phone" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.phone}
                                          </div>
                                        </div>
                                        <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="last_name" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.last_name}
                                          </div>
                                        </div>
                                        <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="address1" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.address1}
                                          </div>
                                        </div>
                                        <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="address1" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.address1}
                                          </div>
                                        </div>
                                        <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="address2" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            {address.address2}
                                          </div>
                                        </div>
                                        <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="city" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.city}
                                          </div>
                                        </div>
                                        <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="state" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.state}
                                          </div>
                                        </div>
                                        <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                          <div className="text-sm font-medium text-gray-500">
                                              <FormattedMessage id="country_id" />
                                          </div>
                                          <div className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                              {address.country_id}
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </CardContent>
                              </Card>
                            </div>
                          );
                        })}
                      </CardContent>
                    </Card>
                  </>
                )}
              </div>
            </div>
          </div>
        </div>
      </main>
    </AvoRedApp>
  );
};
