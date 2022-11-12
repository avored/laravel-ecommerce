import React, { createContext, useState } from "react";

interface AuthContextProviderProps {
    children: React.ReactNode,
}

interface AuthContextShape {
    loggedIn: boolean;
    checkAuth: () => void;
};

export const AuthContext = createContext({} as AuthContextShape)

export const AuthContextProvider = ({children}: AuthContextProviderProps) => {
    const [loggedIn, setLoggedIn] = useState<boolean>(false);

    const checkAuth = () => {
        setLoggedIn(true);
    };
    const logout = () => {
        setLoggedIn(false);
    };

    return <AuthContext.Provider value={{loggedIn, checkAuth}}>
        <div>
            {loggedIn ? <button onClick={logout}>Log out</button> : <button onClick={checkAuth}>Log In</button>}
        </div>
        {children}
    </AuthContext.Provider>
}


