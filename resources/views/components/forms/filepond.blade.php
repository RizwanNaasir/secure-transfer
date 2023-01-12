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
    function uploadFile({fieldName,file,progress,load,error,abort}) {
        // fieldName is the name of the input field
        // file is the actual file object to send
        const formData = new FormData();
        formData.append(fieldName, file, file.name);
        formData.append('id', {{auth()->id()}});

        const request = new XMLHttpRequest();
        request.open('POST', '/user/update');
        request.setRequestHeader('x-csrf-token', document.head.querySelector("[name~=csrf-token][content]").content);
        request.setRequestHeader("Accept", "application/json");

        // Should call the progress method to update the progress to 100% before calling load
        // Setting computable to false switches the loading indicator to infinite mode
        request.upload.onprogress = (e) => {
            progress(e.lengthComputable, e.loaded, e.total);
        };

        // Should call the load method when done and pass the returned server file id
        // this server file id is then used later on when reverting or restoring a file
        // so your server knows which file to return without exposing that info to the client
        request.onload = function () {
            if (request.status >= 200 && request.status < 300) {
                // the load method accepts either a string (id) or an object
                load(request.responseText);
            } else {
                // Can call the error method if something is wrong, should exit after
                error('oh no');
            }
        };

        request.send(formData);

        // Should expose an abort method so the request can be cancelled
        return {
            abort: () => {
                // This function is entered if the user has tapped the cancel button
                request.abort();

                // Let FilePond know the request has been cancelled
                abort();
            }
        };
    }

    FilePond.create(document.querySelector('input[name="{{$element}}"]'),
        {
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    return uploadFile({fieldName,file,progress,load,error,abort});
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