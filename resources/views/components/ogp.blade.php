@props(['title', 'description'])

<meta property="og:title" content="{{ trim($title.' '.config('app.name')) }}">
<meta property="og:description" content="{{ $description ?? '' }}">
