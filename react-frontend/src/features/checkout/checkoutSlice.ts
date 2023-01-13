import { createAsyncThunk, createSlice, PayloadAction } from '@reduxjs/toolkit';
import { RootState } from '../../app/store';

export interface CheckoutState {
  customer_id: string
  shipping_address_id: string
  billing_address_id: string
  shipping_method: string
  payment_method: string
}

const initialState: CheckoutState = {
  customer_id: '',
  shipping_address_id: '',
  billing_address_id: '',
  shipping_method: '',
  payment_method: ''
};

export const checkoutSlice = createSlice({
  name: 'checkout',
  initialState,
  reducers: {
    setCustomerId: (state, action: PayloadAction<string>) => {
      state.customer_id = action.payload;
    },
    setShippingAddressId: (state, action: PayloadAction<string>) => {
      state.shipping_address_id = action.payload;
    },
    setBillingAddressId: (state, action: PayloadAction<string>) => {
      state.billing_address_id = action.payload;
    },
    setShippingMethod: (state, action: PayloadAction<string>) => {
      state.shipping_method = action.payload;
    },
    setPaymentMethod: (state, action: PayloadAction<string>) => {
      state.payment_method = action.payload;
    },
  },

});

export const { 
  setCustomerId, 
  setShippingAddressId,
  setBillingAddressId,
  setShippingMethod,
  setPaymentMethod
} = checkoutSlice.actions;

export const getCheckoutInformation = (state: RootState) => state.checkout;
export const getCheckoutCustomerId = (state: RootState) => state.checkout.customer_id;
export const getCheckoutShippingAddressId = (state: RootState) => state.checkout.shipping_address_id;
export const getCheckoutBillingAddressId = (state: RootState) => state.checkout.billing_address_id;
export const getCheckoutShippingMethod = (state: RootState) => state.checkout.shipping_method;
export const getCheckoutPaymentMethod = (state: RootState) => state.checkout.payment_method;


export default checkoutSlice.reducer;
