import React from 'react';
const Layout = ({children}) => {
    return (
        <>
            <main className="page-wrapper">
                {children}
            </main>
        </>
    )
}
export default Layout;
