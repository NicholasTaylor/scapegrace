import React, { useState, useMemo, useCallback } from 'react';
import { createEditor, BaseEditor, Descendant } from 'slate';
import { Slate, Editable, withReact, ReactEditor } from 'slate-react';

interface WysiwygProps {
    initValue: string
}

type CustomElement = { 
    type: 'paragraph'; 
    children: CustomText[]; 
}

type CustomText = {
    text: string
}

declare module 'slate' {
    interface CustomTypes {
        Editor: BaseEditor & ReactEditor
        Element: CustomElement
        Text: CustomText
    }
}

const Wysiwyg = (props: WysiwygProps) => {
    const editor = useMemo(() => withReact(createEditor()), []);
    const initialValue: Descendant[] = [
        {
            type: 'paragraph',
            children: [{ text: 'A cat is fine too.'}]
            /*
            children: [{ text: props.initValue }]
            */

        }
    ];
    const renderElement = useCallback(props => {
        switch (props.element.type) {
            default:
                return <DefaultElement {...props} />
        }
    }, [])
    return (
        <Slate 
            editor={editor} 
            value={initialValue}
        >
            <Editable
                renderElement={renderElement}
                onKeyDown={event => {
                    console.log(event.key)
                }}
            />
        </Slate>
    )
}

const DefaultElement = (props: HTMLElement) => {
    return <p {...props.attributes}>{props.children}</p>
}

/*

                <ContentEditable
                    onChange={useCallback((e) => {handleWYSIWYG(e)},[body])}
                    html={body}
                    css={css`
                        border: 2px dotted #808080;
                    `}
                /> 
*/

export default Wysiwyg;