@include('partials.header')

<body class="dark:bg-gray-900">
    @include('partials.navbar')
    <div class="flex flex-col justify-center max-w-screen-md m-auto mt-30">
        {{ $slot }}
    </div>
    @include('partials.footer')
    @livewireScripts
</body>

</html>
