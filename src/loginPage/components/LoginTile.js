import React from 'react'

import styles from './LoginTile.module.css'
import LoginTitle from './LoginTitle'

function LoginTile()
{
    
    return(
        <div className={styles.LoginTile}>
            <LoginTitle />
        </div>
    );
}

export default LoginTile;