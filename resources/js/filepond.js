import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImageEdit from 'filepond-plugin-image-edit';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';

// Get a reference to the file input element
const avatar = document.querySelector('input[name="avatar"]');


/*
We need to register the required plugins to do image manipulation and previewing.
*/
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

    FilePondPluginImageEdit
);

// Select the file input and use create() to turn it into a pond
// in this example we pass properties along with the create method
// we could have also put these on the file input element itself


FilePond.create(document2,
    {
        server: '/pond',
        labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
        imagePreviewHeight: 170,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 200,
        imageResizeTargetHeight: 200,
        stylePanelLayout: 'compact',
        styleLoadIndicatorPosition: 'center bottom',
        styleButtonRemoveItemPosition: 'center bottom',
    }
);