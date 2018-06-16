@include('includes/head')
<body>
    <div id="app">
        @include('modules/dashboard-header')
        <main class="py-4">
            @yield('content')
        </main>
        @include('modules/common-footer')
    </div>
    @include('includes/footer')
</body></html>