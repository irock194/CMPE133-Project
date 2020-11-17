import React from 'react';

import styles from './LoginContainer.module.css'
import InnerLoginContent from './InnerLoginContent'

function LoginContainer()
{
    
    return(
        <div className={styles.login_content}>
            <InnerLoginContent />
        </div>
    );
}

export default LoginContainer;