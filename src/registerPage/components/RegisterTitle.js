import React from 'react'

import styles from './RegisterTitle.module.css'
import FieldList from './FieldList'

function RegisterTitle()
{
    
    return(
        <div class={styles.register_title}>
            <FieldList />
        </div>
    );
}

export default RegisterTitle;