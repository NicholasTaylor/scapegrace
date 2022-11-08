import React, { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import EditArticle from './pages/EditArticle';

const container = document.getElementById('editArticle')!;
const props = Object.assign({}, container?.dataset)
const root = createRoot(container);
root.render(<StrictMode><EditArticle {...props}/></StrictMode>);