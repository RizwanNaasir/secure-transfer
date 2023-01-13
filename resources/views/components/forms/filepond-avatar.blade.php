@props([
    'element','path','sourceImage','wireModel'
])
<div>

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
                    source: '{{auth()->user()->avatar_path}}',
                    options: {type: 'local'},
                }],
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                imagePreviewHeight: 170,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 200,
                stylePanelLayout: 'compact circle',
                styleLoadIndicatorPosition: 'center bottom',
                styleButtonRemoveItemPosition: 'center bottom',
            }
        );
    </script>
</div>