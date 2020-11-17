import React from 'react'

import styles from './LoginTitle.module.css'
import FieldList from './FieldList'

function LoginTitle()
{
    
    return(
        <div class={styles.login_title}>
            <FieldList />
        </div>
    );
}

export default LoginTitle;