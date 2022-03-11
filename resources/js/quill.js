import Quill from 'quill/core';

import Toolbar from 'quill/modules/toolbar';
import Snow from 'quill/themes/snow';

import Bold from 'quill/formats/bold';
import Italic from 'quill/formats/italic';
import Underline from 'quill/formats/underline';
import Header from 'quill/formats/header';
import Link from 'quill/formats/link';
import { FontStyle, FontClass } from 'quill/formats/font';
import { AlignAttribute, AlignClass, AlignStyle } from 'quill/formats/align';
import Image from 'quill/formats/image';
import List, { ListItem } from 'quill/formats/list';
import Blockquote from 'quill/formats/blockquote';
import Strike from 'quill/formats/strike';
import CodeBlock, { Code } from 'quill/formats/code';

import Parchment from 'parchment';

class ImageNew extends Parchment.Embed {
    //
}

ImageNew.blotName = 'imageNew';
Image.tagName = 'IMGNEW';

Quill.register({
  'modules/toolbar': Toolbar,
  'themes/snow': Snow,
  'formats/bold': Bold,
  'formats/italic': Italic,
  'formats/underline': Underline,
  'formats/strike': Strike,
  'formats/link': Link,
  'formats/header': Header,
  'formats/font-style': FontStyle,
  'formats/font-class': FontClass,
  'formats/align-attribute': AlignAttribute,
  'formats/align-class': AlignClass,
  'formats/align-style': AlignStyle,
  'formats/image': Image,
  'formats/list': List,
  'formats/list-item': ListItem,
  'formats/blockquote': Blockquote,
  'formats/code-block': CodeBlock,
  'formats/code': Code
});

const toolbarOptions = [
    [{ 'header': ['1', '2', '3', false] }],
    [{ 'font': [] }],
    ['bold', 'italic', 'underline', 'strike', 'link'],
    ['blockquote', 'code', 'image'],
    [{ 'align': [] }],
    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
    ['clean']
];

const options = {
    theme: 'snow',
    modules: {
        toolbar: toolbarOptions
    }
}

const quill = new Quill('#body', options);
/*console.log(JSON.stringify(quill.getContents()));*/