import React from 'react'

import styles from './InputField.module.css'

function InputField({ text })
{
    
    return(
        <input type="text" name="UserName" placeholder={text}></input>
    );
}

export default InputField;