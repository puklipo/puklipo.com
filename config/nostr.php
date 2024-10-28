<?php

return [
    /**
     * Supported: "node", "native".
     */
    'driver' => env('NOSTR_DRIVER', 'native'),

    /**
     * @see https://github.com/kawax/nostr-vercel-api
     */
    'api_base' => env('NOSTR_API_BASE', 'https://nostr-vercel-api.vercel.app/api/'),

    'keys' => [
        'bot_pk' => env('NOSTR_PK'),
    ],

    /**
     * The first relay is used as the primary relay.
     */
    'relays' => [
        'wss://relay.nostr.band',

        'wss://relay.damus.io',
    ],
];
