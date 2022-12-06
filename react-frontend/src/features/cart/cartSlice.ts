import { createAsyncThunk, createSlice, PayloadAction } from '@reduxjs/toolkit';
import { RootState } from '../../app/store';

export interface CartState {
  visitor_id: string
}

const initialState: CartState = {
  visitor_id: '1fea5356-4835-45fc-9b96-057b22b99a96'
};

export const cartSlice = createSlice({
  name: 'cart',
  initialState,
  reducers: {
    setVisitorId: (state, action: PayloadAction<string>) => {
      state.visitor_id = action.payload;
    },
    
  },

});

export const { setVisitorId } = cartSlice.actions;

export const visitorId = (state: RootState) => state.cart.visitor_id;


export default cartSlice.reducer;
