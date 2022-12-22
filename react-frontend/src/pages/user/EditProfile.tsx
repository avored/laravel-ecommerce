import { PencilIcon } from "@heroicons/react/24/solid";
import { get } from "lodash";
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { useMutation } from "urql";
import { useAppSelector } from "../../app/hooks";
import { FormInput } from "../../components/Form/FormInput";
import { FormLabel } from "../../components/Form/FormLabel";
import { Header } from "../../components/Header";
import { getAuthUserInfo } from "../../features/userLogin/userLoginSlice";
import { UserSidebar } from "./UserSidebar";

const customerUpdate = `
    mutation CustomerUpdate(
      $firstName: String!
      $lastName: String!
      $profileImage: Upload
    ) {
      customerUpdate(   
          first_name: $firstName
          last_name: $lastName
          profile_image: $profileImage
      ) {
          id
          first_name
          last_name
          image_path_url
          email
          created_at
          updated_at
      }
    }
`;

export const EditProfile = () => {
  const currentUserInfo = useAppSelector(getAuthUserInfo);
  const [customerUpdateResult, customerUpdateMutation] =
    useMutation(customerUpdate);

  const [firstName, setFirstName] = useState(currentUserInfo.first_name);
  const [lastName, setLastName] = useState(currentUserInfo.last_name);
  const [emailName, setEmail] = useState(currentUserInfo.email);
  const [profileImage, setProfileImage] = useState<File>();

  const firstNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFirstName(e.target.value);
  };
  const lastNameOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setLastName(e.target.value);
  };
  const emailOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEmail(e.target.value);
  };
  const profileImageOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const files = e.target.files;
    setProfileImage(get(files, '0'));

  };

  const navigate = useNavigate()
  
  const submitHandle = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const variables = { firstName, lastName, profileImage };
    await customerUpdateMutation(variables);

    const customerID = get(customerUpdateResult, "data.customerUpdate.id");

    if (customerID) {
      navigate('/user/profile')
    }
  };

  return (
    <div className="min-h-full">
      <Header />

      <header className="bg-white shadow">
        <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold tracking-tight text-gray-900">
            User Profile Page
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
              <form className="flex-1 ml-3" onSubmit={submitHandle}>
                <div className="">
                  <div className="flex w-full">
                    <div className="w-5/6 font-semibold">
                      <div className="space-y-1 rounded-md shadow-sm">
                        <FormLabel forId="first-name" labelText="First Name" />
                        <FormInput
                          value={firstName}
                          id="first-name"
                          type="text"
                          setOnChange={firstNameOnChange}
                          placeholder="First Name"
                        />
                      </div>
                    </div>
                  </div>
                  <div className="flex w-full">
                    <div className="w-5/6 font-semibold">
                      <div className="space-y-1 rounded-md shadow-sm">
                        <FormLabel forId="last-name" labelText="Last Name" />
                        <FormInput
                          value={lastName}
                          id="last-name"
                          type="text"
                          setOnChange={lastNameOnChange}
                          placeholder="Last Name"
                        />
                      </div>
                    </div>
                  </div>
                  <div className="flex w-full">
                    <div className="w-5/6 font-semibold">
                      <div className="space-y-1 rounded-md shadow-sm">
                        <FormLabel forId="email" labelText="Email Address" />
                        <FormInput
                          value={emailName}
                          disabled={true}
                          id="email"
                          type="text"
                          setOnChange={emailOnChange}
                          placeholder="Email Address"
                        />
                      </div>
                    </div>
                  </div>
                  <div className="flex w-full">
                    <div className="w-5/6 font-semibold">
                      <div className="space-y-1 rounded-md shadow-sm">
                        <FormLabel forId="profile-image" labelText="Profile Image" />
                        <FormInput
                          value=''
                          id="profile-image"
                          type="file"
                          setOnChange={profileImageOnChange}
                          placeholder="Profile Image"
                        />
                      </div>
                    </div>
                  </div>

                  <div className="flex mt-5 w-full">
                    <button
                      type="submit"
                      className="group relative pl-10 flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                      <PencilIcon className="absolute w-7 h-7 opacity-40 inset-y-1 left-0 flex items-center pl-3" />
                      Update
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>
    </div>
  );
};
