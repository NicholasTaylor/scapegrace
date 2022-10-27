/** @jsxImportSource @emotion/react */
import { useState } from 'react';
import { css } from '@emotion/react';
import Wysiwyg from './wysiwyg';
import 'modern-normalize';
import EditArticleProvider from './editArticleProvider';
import { Descendant } from 'slate';

interface DataProps {
    article?: string
}

export default function editArticle(props: DataProps){
    const size = [.8, 1, 1.25, 1.563, 1.953, 2.441, 3.052].map((n) => `${n}rem`);

    return(
        <EditArticleProvider 
            dataValue={props.article!}
        >
            <div
                css={css`
                    .wysiwyg {
                        &__toolbarRow {
                            display: flex;
                            flex-flow: row nowrap;
                            justify-content: flex-start;
                        }
                        &__toolbarIcon {
                            flex: 0 0 1.75rem;
                            border: 1px solid #202020;
                            padding: .25rem;
                            img {
                                width: 1.75rem;
                                height: auto;
                            }
                        }
                    }
                `}
            >
                <div
                    id="body"
                    className="wysiwyg"
                    css={css`
                        font-size: ${size[1]};
                        margin: ${size[2]} ${size[2]} ${size[2]} 0;
                        padding: ${size[0]};
                        h1, h2, h3, h4, h5, h6 {
                            font-weight: bold;
                            margin: 0 0 ${size[0]} 0;
                        }
                        h1 {
                            font-size: ${size[6]};
                        }
                        h2 {
                            font-size: ${size[5]};
                        }
                        h3 {
                            font-size: ${size[4]};
                        }
                        h4 {
                            font-size: ${size[3]};
                        }
                        h5 {
                            font-size: ${size[2]};
                        }
                        p {
                            margin: 0 0 ${size[1]} 0;
                        }
                        blockquote {
                            margin: ${size[1]} 0 ${size[1]} 0;
                            padding: 0 0 0 ${size[1]};
                            font-size: ${size[0]};
                            border-left: dotted 6px #808080;
                        }
                    `}
                >
                    <div
                        css={css`
                            border: 2px dotted #808080;
                        `}
                    >
                        <Wysiwyg />
                    </div>
                </div>
            </div>
        </EditArticleProvider>
    )
}