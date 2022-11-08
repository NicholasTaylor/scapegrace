import { ReactElement } from "react";
import { Descendant } from "slate";

export type Props = {
    children: ReactElement
    dataValue: string
}

export type WysiwygProps = {
    initValue: Descendant[]
}

export interface DataProps {
    articleid?: string
}

export type CustomElement = { 
    type: 'paragraph'; 
    children: CustomText[];
}

export type FormattedText = {
    text: string;
    bold?: boolean | null,
    italic?: boolean | null,
    underline?: boolean | null,
    strikethrough?: boolean | null,
}

export type CustomText = FormattedText

export type ContextProps = [
    Descendant[],
    React.Dispatch<React.SetStateAction<Descendant[]>>
]

export type ArticleContextType = {
    appState: {
        articleTxt: Descendant[],
        setArticleTxt: React.Dispatch<React.SetStateAction<Descendant[]>>
    }
}

export type AppStateType = {
    articleTxt: Descendant[];
    setArticleTxt: React.Dispatch<React.SetStateAction<Descendant[]>>;
}