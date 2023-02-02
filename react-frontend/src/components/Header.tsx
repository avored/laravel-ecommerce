import React, { Fragment, useState } from "react";
import { Menu, Transition } from "@headlessui/react";
import Logo from "../logo.svg";
import {
  BellIcon,
  Bars3Icon,
  ChevronDownIcon,
} from "@heroicons/react/24/solid";
import { AuthUserState, getAuthUserInfo, isAuth } from "../features/userLogin/userLoginSlice";
import { useAppSelector } from "../app/hooks";
import { Link } from "react-router-dom";
import { useQuery } from "urql";
import { FormattedMessage } from "react-intl";
interface Category {
  id: string,
  name: string,
  slug: string,
  description: string,
  meta_title: string,
  meta_description: string,
  created_at: Date,
  updated_at: Date,
}

export const Header = () => {
  const isUserLoggedIn = useAppSelector(isAuth);
  const currentUserInfo: AuthUserState = useAppSelector(getAuthUserInfo);

  const CategoryAllQuery = `
      query CategoryAllQuery{
          allCategory {
              id
              name
              slug
              description
              meta_title
              meta_description
              created_at
              updated_at
              
          }
      }
  `;
  const [isMobileMenuVisible, setIsMobileMenuVisible] = useState(false);

  const [{ fetching, data }] = useQuery({query: CategoryAllQuery});

  const triggerMobileMenu = () => {
    setIsMobileMenuVisible((isMobileMenuVisible) => !isMobileMenuVisible);
  };

  const userMenu = () => {
    return (
      <>
        <button
          type="button"
          className="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
        >
          <span className="sr-only">View notifications</span>
          <BellIcon className="h-6 w-6" />
        </button>
        <Menu as="div" className="relative inline-block ml-2 text-left">
          <div>
            <Menu.Button className="inline-flex w-full justify-center rounded-md bg-black bg-opacity-20 px-4 py-2 text-sm font-medium text-white hover:bg-opacity-30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
              <span className="mr-3">
                {currentUserInfo.first_name} {currentUserInfo.last_name}
              </span>
              <img
                className="h-4 w-4 rounded-full"
                src={currentUserInfo.image_path_url}
                alt={`${currentUserInfo.first_name} ${currentUserInfo.last_name} `}
              />
              <ChevronDownIcon
                className="ml-2 -mr-1 h-5 w-5 text-red-200 hover:text-red-100"
                aria-hidden="true"
              />
            </Menu.Button>
          </div>
          <Transition
            as={Fragment}
            enter="transition ease-out duration-100"
            enterFrom="transform opacity-0 scale-95"
            enterTo="transform opacity-100 scale-100"
            leave="transition ease-in duration-75"
            leaveFrom="transform opacity-100 scale-100"
            leaveTo="transform opacity-0 scale-95"
          >
            <Menu.Items className="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
              <div className="px-1 py-1 ">
                <Menu.Item>
                  {({ active }) => (
                    <Link
                      to="/user/edit-profile"
                      className={`${
                        active ? "bg-red-500 text-white" : "text-gray-900"
                      } group flex w-full items-center rounded-md px-2 py-2 text-sm`}
                    >
                      <FormattedMessage id="edit_profile" />
                    </Link>
                  )}
                </Menu.Item>
                <Menu.Item>
                  {({ active }) => (
                    <Link
                      to="/user/orders"
                      className={`${
                        active ? "bg-red-500 text-white" : "text-gray-900"
                      } group flex w-full items-center rounded-md px-2 py-2 text-sm`}
                    >
                      <FormattedMessage id="orders" />
                    </Link>
                  )}
                </Menu.Item>
                <Menu.Item>
                  {({ active }) => (
                    <Link
                      to="/user/addresses"
                      className={`${
                        active ? "bg-red-500 text-white" : "text-gray-900"
                      } group flex w-full items-center rounded-md px-2 py-2 text-sm`}
                    >
                      <FormattedMessage id="addresses" />
                    </Link>
                  )}
                </Menu.Item>
              </div>
              <div className="px-1 py-1">
                <Menu.Item>
                  {({ active }) => (
                    <Link
                      to="/user/logout"
                      className={`${
                        active ? "bg-red-500 text-white" : "text-gray-900"
                      } group flex w-full items-center rounded-md px-2 py-2 text-sm`}
                    >
                      <FormattedMessage id="logout" />
                    </Link>
                  )}
                </Menu.Item>
              </div>
            </Menu.Items>
          </Transition>
        </Menu>
      </>
    );
  };



  return (
    <>
      <nav className="bg-red-700">
        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div className="flex h-16 items-center justify-between">
            <div className="flex items-center">
              <div className="flex-shrink-0">
                <img className="h-8 w-8" src={Logo} alt="AvoRed Ecommerce" />
              </div>
              <div className="hidden md:block">
                <div className="ml-10 flex items-baseline space-x-4">
                  <>
                  <Link to="/"
                    className="text-white px-3 hover:bg-red-600 py-2 rounded-md text-sm font-medium"
                  >
                    Dashboard
                  </Link>
                  
                      {fetching === true ? (
                        <p>Loading</p>
                      ) : (
                        data.allCategory.map((category: Category) => {
                          return <Link className="text-white px-3 hover:bg-red-600 py-2 rounded-md text-sm font-medium" 
                            to={`/category/${category.slug}`} key={category.id}>{category.name}</Link>
                        })
                      )}
                  </>
                </div>
              </div>
            </div>
            <div className="hidden md:block">
              <div className="ml-4 flex items-center md:ml-6">
              <Link className="text-white px-3 hover:bg-red-600 py-2 rounded-md text-sm font-medium" to="/cart">Cart</Link>
                {isUserLoggedIn ? userMenu() : 
                  <>
                  <Link className="text-white px-3 hover:bg-red-600 py-2 rounded-md text-sm font-medium" to="/login">
                    Login
                  </Link>
                  <Link className="text-white px-3 hover:bg-red-600 py-2 rounded-md text-sm font-medium" to="/register">
                    Register
                  </Link>
                  </>
                }
              </div>
            </div>
            <div className="-mr-2 flex md:hidden">
              <button
                type="button"
                className="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-900 hover:bg-white hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 focus:ring-offset-gray-600"
                aria-controls="mobile-menu"
                aria-expanded="false"
              >
                <span className="sr-only">Open main menu</span>

                <Bars3Icon onClick={triggerMobileMenu} className="w-6 h-6" />
              </button>
            </div>
          </div>
        </div>

        <Transition
          show={isMobileMenuVisible}
          enter="transition ease-in-out duration-300 transform"
          enterFrom="-translate-x-full"
          enterTo="translate-x-0"
          leave="transition ease-in-out duration-300 transform"
          leaveFrom="translate-x-0"
          leaveTo="-translate-x-full"
        >
          <div className="md:hidden" id="mobile-menu">
            <div className="space-y-1 px-2 pt-2 pb-3 sm:px-3">

            <Link to="/"
                    className="text-white block px-3 py-2 rounded-md text-base font-medium"
                  >
                    Dashboard
                  </Link>
                  
                      {fetching === true ? (
                        <p>Loading</p>
                      ) : (
                        data.allCategory.map((category: Category) => {
                          return <Link className="text-white block px-3 py-2 rounded-md text-base font-medium" 
                            to={`/category/${category.slug}`} key={category.id}>{category.name}</Link>
                        })
                      )}

            </div>
            <div className="border-t border-gray-700 pt-4 pb-3">
              <div className="flex items-center px-5">
                <div className="flex-shrink-0">
                  <img
                    className="h-10 w-10 rounded-full"
                    src={currentUserInfo.image_path_url}
                    alt={`${currentUserInfo.first_name} ${currentUserInfo.last_name}`}
                  />
                </div>
                <div className="ml-3">
                  <div className="text-base font-medium leading-none text-white">
                    Tom Cook
                  </div>
                  <div className="text-sm font-medium leading-none text-gray-400">
                    tom@example.com
                  </div>
                </div>
                <button
                  type="button"
                  className="ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                >
                  <span className="sr-only">View notifications</span>
                  <BellIcon className="w-6 h-6" />
                </button>
              </div>
              <div className="mt-3 space-y-1 px-2">
                  <Link to="/user/logout" className="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">
                      Logout
                  </Link>
              </div>
            </div>
          </div>
        </Transition>
      </nav>
    </>
  );
};
