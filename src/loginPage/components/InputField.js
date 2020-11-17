import React from 'react'

import styles from './InputField.module.css'

function InputField({ text })
{
    
    return(
        <input type="text" className={styles} name="UserName" placeholder={text}/>
    );
}

export default InputField;