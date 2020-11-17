import React from 'react'

import styles from './InnerRegisterContent.module.css'
import RegisterTile from './RegisterTile'

function InnerRegisterContent()
{
    
    return(
        <div className={styles.inner_register_content}>
            <RegisterTile />
        </div>
    );
}

export default InnerRegisterContent