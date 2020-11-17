import React from 'react';

import styles from './RegisterContainer.module.css'
import InnerRegisterContent from './InnerRegisterContent'

function RegisterContainer()
{
    
    return(
        <div className={styles.register_content}>
            <InnerRegisterContent />
        </div>
    );
}

export default RegisterContainer;