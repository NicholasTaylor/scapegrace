import React from 'react';
import { createRoot } from 'react-dom/client';
import EditArticle from './editArticle';

const container = document.getElementById('editArticle')!;
const props = Object.assign({}, container?.dataset)
const root = createRoot(container);
root.render(<EditArticle {...props}/>);