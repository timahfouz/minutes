@include('admin.layout.header')

<div id="content" class="main-content">
    @yield('content')
</div>

@include('admin.layout.footer')


@stack('scripts')