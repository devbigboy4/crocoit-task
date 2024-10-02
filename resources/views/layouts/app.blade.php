<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.tiny.cloud/1/2wvqnnqeq36z3apxhjgul5qr5mvc36aq3ix38mzdca57rt5f/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        tinymce.init({
            selector: '#description', // Apply TinyMCE to the specific textarea by its ID
            height: 400, // Customize the height of the editor
            plugins: 'link image code lists', // Enable additional plugins
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image', // Define toolbar options
            menubar: false, // Hide the menubar for simplicity
            content_css: '//cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css', // Optionally use Tailwind styling for the content inside TinyMCE
            skin: 'oxide-dark', // Optionally use a dark theme for TinyMCE
            content_style: "body { font-family: 'Inter', sans-serif; font-size: 14px; }" // Style the content inside the editor
        });
    </script>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)

                new Notify({
                    status: 'error',
                    title: '{{ $error }}',
                    effect: 'fade',
                    speed: 300,
                    customClass: '',
                    customIcon: '',
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 3000,
                    notificationsGap: null,
                    notificationsPadding: null,
                    type: 'outline',
                    position: 'right top',
                    customWrapper: '',
                })
            @endforeach
        @endif

        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    round_info_noti(" {{ Session::get('message') }} ")
                    break;

                case 'success':
                    new Notify({
                        status: 'success',
                        title: '{{ Session::get('message') }}',
                        text: '{{ Session::get('message') }}',
                        effect: 'fade',
                        speed: 300,
                        customClass: '',
                        customIcon: '',
                        showIcon: true,
                        showCloseButton: true,
                        autoclose: true,
                        autotimeout: 3000,
                        notificationsGap: null,
                        notificationsPadding: null,
                        type: 'outline',
                        position: 'right top',
                        customWrapper: '',
                    })
                    break;

                case 'warning':
                    new Notify({
                        status: 'warning',
                        title: '{{ Session::get('message') }}',
                        text: '{{ Session::get('message') }}',
                        effect: 'fade',
                        speed: 300,
                        customClass: '',
                        customIcon: '',
                        showIcon: true,
                        showCloseButton: true,
                        autoclose: true,
                        autotimeout: 3000,
                        notificationsGap: null,
                        notificationsPadding: null,
                        type: 'outline',
                        position: 'right top',
                        customWrapper: '',
                    })
                    break;

                case 'error':
                    new Notify({
                        status: 'error',
                        title: '{{ Session::get('message') }}',
                        text: '{{ Session::get('message') }}',
                        effect: 'fade',
                        speed: 300,
                        customClass: '',
                        customIcon: '',
                        showIcon: true,
                        showCloseButton: true,
                        autoclose: true,
                        autotimeout: 3000,
                        notificationsGap: null,
                        notificationsPadding: null,
                        type: 'outline',
                        position: 'right top',
                        customWrapper: '',
                    })
                    break;
            }
        @endif
    </script>

</body>

</html>
