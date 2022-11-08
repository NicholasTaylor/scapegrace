import { createContext, useEffect, useState } from "react";
import { Descendant } from "slate";
import { ArticleContextType } from "../types/Types";

export const articleTxtDefault: Descendant[]= [{type: 'paragraph', children: [{text: ''}]}];
const blankDisp = () => {return null};

export const articleDefaultValue: ArticleContextType = {
    appState: {
        articleTxt: articleTxtDefault,
        setArticleTxt: blankDisp,
    }
};

export const ArticleContext = createContext<ArticleContextType>(articleDefaultValue);

const useArticleContext = (articleid?: number) => {
    const [articleTxt, setArticleTxt] = useState(articleTxtDefault)
    const output: ArticleContextType = {
        appState: {
            articleTxt: articleTxt,
            setArticleTxt: setArticleTxt
        }
    }

    const getArticleTxt = () => {
        if (typeof articleid !== 'undefined'){
            fetch(`http://localhost:8000/admin/article/${articleid}`,{method: 'GET'})
            .then((res)=>{
                return res.json();
            })
            .then((data)=>{
                setArticleTxt([{type: 'paragraph', children: [{text: `${data.body}`}]}]);
                console.log(`Updated body with ${data.body}`)
            })
            .catch((err)=>{
                console.log(err);
            })
        }
    }

    useEffect(()=>{
        getArticleTxt();
    },[])

    return output;
}

export default useArticleContext;