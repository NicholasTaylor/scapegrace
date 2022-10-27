import React, { ReactElement, useState } from 'react';
import { Descendant } from 'slate';


type Props = {
    children: ReactElement
    dataValue: string
}

const generateState = () => {
    return useState([{type: 'paragraph', children: [{text: ''}]}] as Descendant[]);
}

const [articleTxt, setArticleTxt] = generateState();

export const editArticleContext = React.createContext([articleTxt, setArticleTxt]);

const EditArticleProvider = (props: Props) => {
    return(
        <editArticleContext.Provider value={[articleTxt, setArticleTxt]}>
            {props.children}
        </editArticleContext.Provider>
    )
}

export default EditArticleProvider;