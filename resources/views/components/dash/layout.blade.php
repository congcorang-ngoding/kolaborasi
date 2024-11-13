<x-dash.header>
    {{ $title }}
</x-dash.header>
<x-dash.sidebar />
<x-dash.navbar />

{{ $slot }}

<x-dash.footer>
    {{ $title }}
</x-dash.footer>
