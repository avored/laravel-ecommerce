import { createSlice, PayloadAction } from '@reduxjs/toolkit';
import { RootState } from '../../app/store';
import { findLast } from 'lodash';

export interface FlashState {
  messages: Array<FlashMessageState>
}

export interface FlashMessageState {
  message: string
}

const initialState: FlashState = {
  messages: []
};

export const flashSlice = createSlice({
  name: 'flash',
  initialState,
  reducers: {
    setMessage: (state, action: PayloadAction<string>) => {
      state.messages.push({message: action.payload});
    },
    removeLast: (state) => {
      state.messages = []
    },
  },

});

export const { setMessage, removeLast } = flashSlice.actions;

export const lastFlashMessage = (state: RootState) => {
  if (state.flash.messages.length > 0) {
    return findLast(state.flash.messages)
  }

  return
}


export default flashSlice.reducer;
