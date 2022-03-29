import React from 'react';
import { render } from 'react-dom';
import EditArticle from './editArticle';

const container = document.getElementById('editArticle');
const props = Object.assign({}, container?.dataset)

render(<EditArticle {...props}/>, container);