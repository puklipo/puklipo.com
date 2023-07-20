@props(['title', 'description'])

<meta property="og:title" content="{{ trim($title) }}">
<meta property="og:description" content="{{ $description ?? '' }}">
