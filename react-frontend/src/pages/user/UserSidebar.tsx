import React from "react";
import { Link } from "react-router-dom";
import { AuthUserState } from "../../features/userLogin/userLoginSlice";

interface UserSideBarProp {
  user: AuthUserState;
}

export const UserSidebar = (props: UserSideBarProp) => {
  return (

    <div className="text-center">
      <div className="aspect-square">
        <img
          src={props.user.image_path_url}
          alt={`${props.user.first_name} ${props.user.last_name}`}
          className="object-cover w-full h-full rounded-sm"
        />
      </div>

      <div className="mt-3">
        <Link to="/user/edit-profile">Edit Profile</Link>
      </div>
      <div className="mt-3">
        <Link to="/user/orders">Orders</Link>
      </div>
      <div className="mt-3">
        <Link to="/user/addresses">Addresses</Link>
      </div>

      <div className="mt-3">
        <Link to="/user/logout">Logout</Link>
      </div>
    </div>
  );
};
