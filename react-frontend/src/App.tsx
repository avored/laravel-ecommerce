import React from "react";
import {Routes, Route} from "react-router-dom";

import {Index} from "./pages/Index";
import {Product} from "./pages/Product";
import {LoginPage} from "./pages/auth/LoginPage";
import {Profile} from "./pages/user/Profile";
import {PrivateRoute} from "./routes/PrivateRoute";
import {CategoryShow} from "./pages/category/CategoryShow";
import {ProductShow} from "./pages/product/ProductShow";
import {CartShow} from "./pages/cart/CartShow";
import {CheckoutShow} from "./pages/checkout/CheckoutShow";
import {CheckoutShippingAddressShow} from "./pages/checkout/CheckoutShippingAddressShow";
import {CheckoutPaymentShow} from "./pages/checkout/CheckoutPaymentShow";
import {CheckoutShippingShow} from "./pages/checkout/CheckoutShippingShow";
import { CheckoutSummaryShow } from "./pages/checkout/CheckoutSummaryShow";
import { EditProfile } from "./pages/user/EditProfile";
import { UserOrders } from "./pages/user/UserOrders";
import { UserAddresses } from "./pages/user/UserAddresses";
import { UserAddresseCreate } from "./pages/user/UserAddresseCreate";
import { EditAddress } from "./pages/user/EditAddress";
import { UserLogout } from "./pages/user/UserLogout";
import { ForgotPasswordlPage } from "./pages/auth/ForgotPasswordlPage";
import { RegisterPage } from "./pages/auth/RegisterPage";
 
function App() {
    return (
        <>
            <Routes>
                <Route path="/" element={<Index/>}/>
                <Route path="/product" element={<Product/>}/>
                <Route path="/category/:slug" element={<CategoryShow/>}/>
                <Route path="/product/:slug" element={<ProductShow/>}/>
                <Route path="/cart" element={<CartShow/>}/>
                <Route path="/checkout" element={<CheckoutShow/>}/>
                <Route path="/checkout/shipping-address" element={<CheckoutShippingAddressShow/>}/>
                <Route path="/checkout/shipping" element={<CheckoutShippingShow/>}/>
                <Route path="/checkout/payment" element={<CheckoutPaymentShow/>}/>
                <Route path="/checkout/summary" element={<CheckoutSummaryShow/>}/>

                {/* ***********  User Navigation Routes or Protected routes ************  */}
                <Route path="/user" element={<PrivateRoute/>}>
                    <Route path="profile" element={<Profile/>}/>
                    <Route path="edit-profile" element={<EditProfile/>}/>
                    <Route path="orders" element={<UserOrders/>}/>
                    <Route path="addresses" element={<UserAddresses/>}/>
                    <Route path="address/create" element={<UserAddresseCreate/>}/>
                    <Route path="edit-address/:addressId" element={<EditAddress/>}/>
                    <Route path="logout" element={<UserLogout/>}/>
                </Route>

                <Route path="/register" element={<RegisterPage/>}/>
                <Route path="/login" element={<LoginPage/>}/>
                <Route path="/forgot-password" element={<ForgotPasswordlPage/>}/>
            </Routes>
        </>
    );
}

export default App;
