@include('includes/head')
<body>
    <div id="app">
    	@include('modules/landing-header')
        <main class="py-4">
            @yield('content')
        </main>
        @include('modules/common-footer')
    </div>
	@include('includes/footer')
</body></html>