<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @livewireStyles
    @stack('styles')
</head>

<body class="font-sans antialiased z-0">
    <div class="bg-white">
        @yield('content')
        {{ $slot ?? '' }}
    </div>
    @livewire('notifications')
    @livewire('livewire-ui-modal')
    @livewireScripts
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link
            href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css"
            rel="stylesheet"
    />
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-get-file/dist/filepond-plugin-get-file.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(
            // encodes the file as base64 data
            FilePondPluginFileEncode,

            // validates files based on input type
            FilePondPluginFileValidateType,

            // corrects mobile image orientation
            FilePondPluginImageExifOrientation,

            // previews the image
            FilePondPluginImagePreview,

            // crops the image to a certain aspect ratio
            FilePondPluginImageCrop,

            // resizes the image to fit a certain size
            FilePondPluginImageResize,

            // applies crop and resize information on the client
            FilePondPluginImageTransform,

            // FilePondPluginImageEdit,
            FilePondPluginGetFile
        );
    </script>
    @yield('scripts')
    @stack('scripts')
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</body>
</html>
