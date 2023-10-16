@include('partials.header')

<body class="dark:bg-gray-900">

    @include('partials.navbar')
    <div class="mt-30 max-w-screen-md flex flex-col justify-center m-auto">
        {{ $slot }}
    </div>

    @include('partials.footer')
    <script src="@vite('node_modules/flowbite/dist/flowbite.min.js')"></script>
    <script src="@vite('resources/js/flowbite.js')"></script>
    {{-- @livewireScripts --}}
</body>

</html>
