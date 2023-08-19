import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import hljs from 'highlight.js/lib/core';
import 'highlight.js/styles/devibeans.css'
import php from 'highlight.js/lib/languages/php';
hljs.registerLanguage('php', php);
hljs.highlightAll()
