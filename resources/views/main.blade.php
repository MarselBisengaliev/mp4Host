@include('templates.header')

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if (session('message'))
    {{ session('message') }}
@endif

@yield('content')
@include('templates.footer')
