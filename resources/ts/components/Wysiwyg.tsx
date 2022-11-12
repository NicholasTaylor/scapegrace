/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import React, { useCallback, useContext, useRef, useState } from 'react';
import { createEditor, BaseEditor, Transforms, Text, Editor, Node, Descendant } from 'slate';
import { Slate, Editable, withReact, ReactEditor, RenderLeafProps} from 'slate-react';
import { withHistory } from 'slate-history';
import bold from '@/wysiwyg-assets/bold.svg';
import italic from '@/wysiwyg-assets/italic.svg';
import underline from '@/wysiwyg-assets/underline.svg';
import strikethrough from '@/wysiwyg-assets/strikethrough.svg';
import link from '@/wysiwyg-assets/link.svg';
import { CustomElement, CustomText, WysiwygProps } from '../types/Types';
import { ArticleContext, articleTxtDefault } from '../contexts/EditArticleContext';
import ErrorBoundary from '../components/ErrorBoundary'

declare module 'slate' {
    interface CustomTypes {
        Editor: BaseEditor & ReactEditor
        Element: CustomElement
        Text: CustomText
    }
}

const Wysiwyg = (props: WysiwygProps) => {
    /*let [articleTxt, setArticleTxt] = useContext(editArticleContext);*/
    
    const { appState } = useContext(ArticleContext);
    const [testValue, setTestValue] = useState(appState.articleTxt)

    /*const [editor] = useState(() => withReact(createEditor()));*/
    /*const editor = useMemo(()=>withHistory(withReact(createEditor())),[appState.articleTxt])*/
    const editorRef: React.MutableRefObject<undefined | BaseEditor & ReactEditor> = useRef()
    if (!editorRef.current) editorRef.current = withHistory(withReact(createEditor()))
    const editor = editorRef.current
    
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
    const serialize = (value: Descendant[]) => {
        value.forEach(n => console.log(`Node test:\n${JSON.stringify(Node.elements(n))}`))
        /*console.log(`Node test:\n${Node.texts(value[0])}`)*/
        return(
            value.map((n: Descendant) => Node.string(n))
            .join('\n')
        )
    }
    const changeValue = (value: Descendant[]) => {
        const isAstChange = editor.operations.some(
            op => 'set_selection' !== op.type
        )
        if (isAstChange) {
            setTestValue(value)
        }
    }
    return (
        <ErrorBoundary>
            <div>
                {serialize(testValue)}<br />
                {JSON.stringify(testValue)}
            </div>
            <Slate
                editor={editor}
                value={appState.articleTxt}
                onChange={value => changeValue(value)}
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
                                src={bold}
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
                                src={italic}
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
                                src={underline}
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
                                src={strikethrough}
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
                                src={link}
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
        </ErrorBoundary>
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

const getTagName = (props: RenderLeafProps) => {
    if (!props.leaf){
        return;
    }
    let tags = Object.keys(props.leaf);
    let txtIdx = tags.indexOf('text');
    if (txtIdx > -1){
        tags.splice(txtIdx, 1);
    }
    if (tags.length === 0){
        return;
    }
    return tags.join(' ');
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
            data-tags={getTagName(props)}
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