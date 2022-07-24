/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import React, { useState, useMemo, useCallback } from 'react';
import { createEditor, BaseEditor, Descendant, Transforms, Text, Editor, Element } from 'slate';
import { Slate, Editable, withReact, ReactEditor, RenderLeafProps} from 'slate-react';

interface WysiwygProps {
    initValue: string
}

type CustomElement = { 
    type: 'paragraph'; 
    children: CustomText[];
}

type FormattedText = {
    text: string;
    bold?: boolean | null,
    italic?: boolean | null,
    underline?: boolean | null,
    strikethrough?: boolean | null,
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
        isMarkActive(editor: Editor, mark: string){
            const [match] = Editor.nodes(
                editor, 
                {match: n => Text.isText(n) && n[mark as keyof typeof n] === true, universal: true}
            )
            return !!match
        },
        toggleMark(editor: Editor, mark: string){
            const isActive = CustomEditor.isMarkActive(editor, mark)
            Transforms.setNodes(
                editor,
                {[mark]: isActive ? null : true},
                {match: n => Text.isText(n), split: true}
            )
        }
    }
    return (
        <Slate 
            editor={editor} 
            value={initialValue}
            onChange={(value) => {
                console.log(value);
            }}
        >
            <div
                className="wysiwyg__toolbar"
            >
                <div
                    className="wysiwyg__toolbarRow"
                >
                    <span
                        className="wysiwyg__toolbarIcon wysiwyg__btn"
                        data-action="bold"
                        data-tag-name="strong"
                        title="Bold"
                        onClick={(event) => {
                            event.preventDefault();
                            CustomEditor.toggleMark(editor, 'bold');
                        }}
                    >
                        <img
                            src="/wysiwyg-assets/bold.svg"
                        />
                    </span>
                    <span
                        className="wysiwyg__toolbarIcon wysiwyg__btn"
                        data-action="italic"
                        data-tag-name="em"
                        title="Italic"
                        onClick={(event) => {
                            event.preventDefault();
                            CustomEditor.toggleMark(editor, 'italic');
                        }}
                    >
                        <img
                            src="/wysiwyg-assets/italic.svg"
                        />
                    </span>
                    <span
                        className="wysiwyg__toolbarIcon wysiwyg__btn"
                        data-action="underline"
                        data-tag-name="u"
                        title="Underline"
                        onClick={(event) => {
                            event.preventDefault();
                            CustomEditor.toggleMark(editor, 'underline');
                        }}
                    >
                        <img
                            src="/wysiwyg-assets/underline.svg"
                        />
                    </span>
                    <span
                        className="wysiwyg__toolbarIcon wysiwyg__btn"
                        data-action="strikethrough"
                        data-tag-name="strike"
                        title="Strikethrough"
                        onClick={(event) => {
                            event.preventDefault();
                            CustomEditor.toggleMark(editor, 'strikethrough');
                        }}
                    >
                        <img
                            src="/wysiwyg-assets/strikethrough.svg"
                        />
                    </span>
                </div>
            </div>
            <div
                className="wysiwyg__toolbar"
            >
                <div
                    className="wysiwyg__toolbarRow"
                >
                    <span
                        className="wysiwyg__toolbarIcon wysiwyg__btn"
                        data-action="createLink"
                        data-tag-name="a"
                        title="Link"
                    >
                        <img
                            src="/wysiwyg-assets/link.svg"
                        />
                    </span>
                </div>
            </div>
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
                            CustomEditor.toggleMark(editor, 'bold');
                            break;
                        }
                        case 'i': {
                            event.preventDefault();
                            CustomEditor.toggleMark(editor, 'italic');
                            break;
                        }
                        case 'u': {
                            event.preventDefault();
                            CustomEditor.toggleMark(editor, 'underline');
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

const checkTextDecoration = (underline: boolean | undefined | null, strikethrough: boolean | undefined | null) => {
    if (underline && strikethrough){
        return 'line-through underline';
    } else if (underline) {
        return 'underline';
    } else if (strikethrough) {
        return 'line-through';
    } else {
        return 'none';
    }
}

const Leaf = (props: RenderLeafProps) => {
    return (
        <span
            {...props.attributes}
            style={{ 
                fontWeight: props.leaf.bold ? 'bold' : 'normal', 
                fontStyle: props.leaf.italic ? 'italic' : 'normal',
                textDecoration: checkTextDecoration(props.leaf.underline, props.leaf.strikethrough)
            }}
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