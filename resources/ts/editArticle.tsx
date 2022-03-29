/** @jsxImportSource @emotion/react */
import React, { useState, useEffect, useCallback } from 'react';
import { css } from '@emotion/react';
import ContentEditable from 'react-contenteditable';
import 'modern-normalize';

interface Article {
    id?: Number,
    user_id?: Number,
    title?: String,
    slug?: String,
    excerpt?: String,
    body?: string,
    category_id?: Number,
    tags?: Array<Number>,
    published?: Number | Date,
    published_at?: Date,
    created_at?: Date,
    updated_at?: Date
}
interface ArticleProps {
    article?: string
}

export default function editArticle(props: ArticleProps){
    const articleInit: Article = JSON.parse(props.article!);
    const [id, setId] = useState(articleInit.id!);
    const [user_id, setUser_id] = useState(articleInit.user_id!);
    const [title, setTitle] = useState(articleInit.title!);
    const [slug, setSlug] = useState(articleInit.slug!);
    const [excerpt, setExcerpt] = useState(articleInit.excerpt!);
    const [body, setBody] = useState(articleInit.body!);
    const [category_id, setCategory_id] = useState(articleInit.category_id!);
    const [tags, setTags] = useState(articleInit.tags!);
    const [published, setPublished] = useState(articleInit.published!);
    const [published_at, setPublished_at] = useState(articleInit.published_at!);
    const [created_at, setCreated_at] = useState(articleInit.created_at!);
    const [updated_at, setUpdated_at] = useState(articleInit.updated_at!);
    
    const size = [.8, 1, 1.25, 1.563, 1.953, 2.441, 3.052].map((n) => `${n}rem`);

    const handleWYSIWYG: Function = (e: React.ChangeEvent<HTMLInputElement>) => {
        setBody(e.target.value!);
    }

    return(
        <div>
            Hello world!<br/>
            <div
                css={css`
                    font-size: ${size[1]};
                    margin: ${size[2]} ${size[2]} ${size[2]} 0;
                    padding: ${size[0]};
                    border: 2px dotted #808080;
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
                <ContentEditable
                    onChange={useCallback((e) => {handleWYSIWYG(e)},[body])}
                    html={body}
                />
            </div>
        </div>
    )
}