import { createAsyncThunk, createSlice, PayloadAction } from '@reduxjs/toolkit';
import { RootState } from '../../app/store';

export interface AuthUserState {
  access_token: string,
  isAuth: boolean,
  status: 'idle' | 'loading' | 'failed'
}

const initialState: AuthUserState = {
  access_token: '',
  isAuth: false,
  status: 'idle',
};

export const userLoginSlice = createSlice({
  name: 'userLogin',
  initialState,
  reducers: {
    setAccessToken: (state, action: PayloadAction<string>) => {
      state.isAuth = true;
      state.access_token = action.payload;
    },
    setAuth: (state, action: PayloadAction<boolean>) => {
      state.isAuth = action.payload;
    },
  },

});

export const { setAccessToken, setAuth } = userLoginSlice.actions;

export const accessToken = (state: RootState) => state.userLogin.access_token;
export const isAuth = (state: RootState) => state.userLogin.isAuth;


export default userLoginSlice.reducer;
