@props(['checked' => false])

<input type="checkbox" {!! $attributes->merge(['class' => 'rounded-sm dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-xs focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800']) !!} @checked($checked)>
