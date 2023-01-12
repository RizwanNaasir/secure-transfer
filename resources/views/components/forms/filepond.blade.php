@props([
    'element','path','sourceImage','wireModel'
])
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
<script>
    FilePond.create(document.querySelector('input[name="{{$element}}"]'),
        {
            server: {
                server: {
                    process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('{{ $wireModel }}', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('{{ $wireModel }}', filename, load)
                    },
                },
                load: (source, load, error, progress, abort, headers) => {
                    // now load it using XMLHttpRequest as a blob then load it.
                    let request = new XMLHttpRequest();
                    request.open('GET', source);
                    request.responseType = "blob";
                    request.onreadystatechange = () => request.readyState === 4 && load(request.response);
                    request.send();
                },
            },
            acceptedFileTypes: ['image/png', 'image/jpeg'],
            files: [{
                source: '{{$sourceImage}}',
                options: {type: 'local'},
            }],
            labelIdle: `Drag & Drop your picture or <span {{ $attributes->class(['filepond--label-action']) }}>Browse</span>`,
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact',
        }
    );
</script>