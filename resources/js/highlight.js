import hljs from 'highlight.js/lib/core';
import 'highlight.js/styles/devibeans.css'
import php from 'highlight.js/lib/languages/php';
import css from 'highlight.js/lib/languages/css';
import javascript from 'highlight.js/lib/languages/javascript';
import json from 'highlight.js/lib/languages/json';

hljs.registerLanguage('php', php);
hljs.registerLanguage('css', css);
hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('json', json);
hljs.highlightAll()

Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
    // Runs immediately before a commit's payload is sent to the server...

    respond(() => {
        // Runs after a response is received but before it's processed...
    })

    succeed(({ snapshot, effect }) => {
        queueMicrotask(() => {
            // Equivelant of 'message.processed'
            hljs.highlightAll()
        })
    })

    fail(() => {
        // Runs if some part of the request failed...
    })
})

document.addEventListener('livewire:navigated', () => {
    hljs.highlightAll();
})
