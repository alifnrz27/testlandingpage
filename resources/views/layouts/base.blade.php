<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link rel="stylesheet" href="{{asset('src/css/output.css')}}">
        <link rel="stylesheet" href="{{asset('src/css/style.css')}}">

        {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
        <link rel="stylesheet" href="{{ asset('build/assets/app-7bf6ca24.css') }}">
        <script type="module" src="{{ asset('build/assets/app-69332da4.js') }}"></script>


        {{-- cropperJS --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
        @livewireStyles
        @livewireScripts

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="hide-scrollbar">
        @yield('body')

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>

            window.addEventListener('modal', event=> {
                Swal.fire({
                    position: 'center',
                    icon: event.detail.type,
                    title: event.detail.title,
                    showConfirmButton: true,
                    });
            });

            window.addEventListener('confirm', event=>{
                Swal.fire({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: event.detail.confirmButtonText,
                    cancelButtonText: 'Batal'
                })
                .then((result) => {
                    if(result.isConfirmed){
                        window.livewire.emit(event.detail.useMethod, event.detail.key);
                        console.log(event.detail.key);
                    }
                });
            });
        </script>
    </body>
</html>
