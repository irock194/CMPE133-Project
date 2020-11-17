import React from 'react'

import styles from './RegisterTile.module.css'
import RegisterTitle from './RegisterTitle'

function RegisterTile()
{
    
    return(
        <div className={styles.register_tile}>
            <RegisterTitle />
        </div>
    );
}

export default RegisterTile;