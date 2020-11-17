import React from 'react'

import styles from './InnerLoginContent.module.css'
import LoginTile from './LoginTile'

function InnerLoginContent()
{
    
    return(
        <div className={styles.InnerLoginContent}>
            <LoginTile />
        </div>
    );
}

export default InnerLoginContent