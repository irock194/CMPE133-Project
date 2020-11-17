import React from 'react'

import styles from './InputButton.module.css'

function InputButton({ text })
{
    
    return(
        <input type="button" name="Submit" value={text}></input>
    );
}

export default InputButton;