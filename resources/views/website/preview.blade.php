<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .container {
            max-width: 1100px !important;
        }
    </style>
</head>

<body class="text-justify">
    <x-parts.header></x-parts.header>
    <main class="flex flex-col">
        <x-parts.hero></x-parts.hero>
        <x-parts.lead></x-parts.lead>
        <x-parts.cards></x-parts.cards>
        <x-parts.cta></x-parts.cta>
        <x-parts.list></x-parts.list>
        <x-parts.table></x-parts.table>
    </main>

    <x-parts.footer></x-parts.footer>
</body>
