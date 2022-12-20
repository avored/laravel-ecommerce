import { createAsyncThunk, createSlice, PayloadAction } from '@reduxjs/toolkit';
import { RootState } from '../../app/store';

export interface AuthUserState {
  id: string,
  first_name: string,
  last_name: string,
  email: string,
  image_path_url: string,
  created_at: string,
  updated_at: string,
  isAuth: boolean,
  token_info: {
    access_token: string,
    token_type: string,
    expires_in: number,
    refresh_token: string
  },
  status: 'idle' | 'loading' | 'failed'
}

const initialState: AuthUserState = {
  id: '',
  first_name: '',
  last_name: '',
  email: '',
  image_path_url: '',
  created_at: '',
  updated_at: '',
  token_info: {
    access_token : '',
    token_type: '',
    expires_in: 0,
    refresh_token: ''
  },
  isAuth: false,
  status: 'idle',
};

export const userLoginSlice = createSlice({
  name: 'userLogin',
  initialState,
  reducers: {
    setAuthInfo: (state, action: PayloadAction<AuthUserState>) => {
      state.id = action.payload.id;
      state.first_name = action.payload.first_name;
      state.last_name = action.payload.last_name;
      state.email = action.payload.email;
      state.image_path_url = action.payload.image_path_url;
      state.created_at = action.payload.created_at;
      state.updated_at = action.payload.updated_at
      state.token_info.token_type = action.payload.token_info.token_type;
      state.token_info.access_token = action.payload.token_info.access_token;
      state.token_info.expires_in = action.payload.token_info.expires_in;
      state.token_info.refresh_token = action.payload.token_info.refresh_token;

      localStorage.setItem('access_token', action.payload.token_info.access_token)
    },
    setIsAuth: (state, action: PayloadAction<boolean>) => {
      state.isAuth = action.payload;
    },
    performUserLogout: (state, action: PayloadAction<boolean>) => {
      if (action.payload) {
        state.id = '';
        state.first_name = '';
        state.last_name = ''
        state.email = '';
        state.image_path_url = '';
        state.created_at = '';
        state.updated_at = ''
        state.token_info.token_type = '';
        state.token_info.access_token = '';
        state.token_info.expires_in = 0;
        state.token_info.refresh_token = '';
        state.isAuth = false;
      }
    },
  },

});

export const { setAuthInfo, setIsAuth, performUserLogout } = userLoginSlice.actions;

export const getAuthUserInfo = (state: RootState) => state.userLogin;
export const isAuth = (state: RootState) => state.userLogin.isAuth;


export default userLoginSlice.reducer;
