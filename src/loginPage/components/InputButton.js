import React from 'react'

import styles from './InputButton.module.css'

function InputButton({ text })
{
    
    return(
        <input type="button" className={styles} name="Submit" value={text}/>
    );
}

export default InputButton;