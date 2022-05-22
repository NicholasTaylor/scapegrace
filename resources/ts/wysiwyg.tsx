import React, { useState, useMemo, useCallback } from 'react';
import { createEditor, BaseEditor, Descendant, Transforms, Text, Editor, Element } from 'slate';
import { Slate, Editable, withReact, ReactEditor, RenderLeafProps} from 'slate-react';
import { node } from 'webpack';

interface WysiwygProps {
    initValue: string
}

type CustomElement = { 
    type: 'paragraph'; 
    children: CustomText[];
}

type FormattedText = {
    text: string;
    bold?: boolean | null
}

type CustomText = FormattedText

declare module 'slate' {
    interface CustomTypes {
        Editor: BaseEditor & ReactEditor
        Element: CustomElement
        Text: CustomText
    }
}

const Wysiwyg = (props: WysiwygProps) => {
    const editor = useMemo(() => withReact(createEditor()), [])
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
    const renderLeaf = useCallback(props => {
        return <Leaf {...props} />
    }, [])
    const CustomEditor = {
        isBoldMarkActive(editor: Editor){
            const [match] = Editor.nodes(
                editor, 
                {match: n => Text.isText(n) && n.bold === true, universal: true}
            )
            return !!match
        },
        toggleBoldMark(editor: Editor){
            const isActive = CustomEditor.isBoldMarkActive(editor)
            Transforms.setNodes(
                editor,
                {bold: isActive ? null : true},
                {match: n => Text.isText(n), split: true}
            )
        }
    }
    return (
        <Slate 
            editor={editor} 
            value={initialValue}
        >
            <Editable
                renderElement={renderElement}
                renderLeaf={renderLeaf}
                onKeyDown={event => {
                    let heldKey = window.navigator.userAgent.indexOf('Mac OS') !== -1 ? event.metaKey : event.ctrlKey;
                    if (!heldKey){
                        return;
                    }
                    switch (event.key){
                        case 'b': {
                            event.preventDefault();
                            CustomEditor.toggleBoldMark(editor);
                            break;
                        }
                    }
                }}
            />
        </Slate>
    )
}

const DefaultElement = (props: HTMLElement) => {
    return <p {...props.attributes}>{props.children}</p>
}

const Leaf = (props: RenderLeafProps) => {
    return (
        <span
            {...props.attributes}
            style={{ fontWeight: props.leaf.bold ? 'bold' : 'normal' }}
        >
            {props.children}
        </span>
    )
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