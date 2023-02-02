import { configureStore, ThunkAction, Action } from '@reduxjs/toolkit';
import counterReducer from '../features/counter/counterSlice';
import userLoginReducer from '../features/userLogin/userLoginSlice';
import cartReducer from '../features/cart/cartSlice';
import checkoutReducer from '../features/checkout/checkoutSlice';
import flashSlice from '../features/flash/flashSlice';

export const store = configureStore({
  reducer: {
    counter: counterReducer,
    userLogin: userLoginReducer,
    cart: cartReducer,
    checkout: checkoutReducer,
    flash: flashSlice
  },
});

export type AppDispatch = typeof store.dispatch;
export type RootState = ReturnType<typeof store.getState>;
export type AppThunk<ReturnType = void> = ThunkAction<
  ReturnType,
  RootState,
  unknown,
  Action<string>
>;
