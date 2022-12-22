@extends('layouts.app')
@section('content')
    @include('layouts.header')

    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">{{ __('lang.add_product') }}</h2>
                {{--<p class="text-gray-500 mb-6">Form is mobile responsive. Give it a try.</p>--}}

                <form action="{{url('user/update-product/'.$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white rounded shadow-lg  md:p-8 mb-6">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-2 lg:grid-cols-2">
                            <div class="text-gray-600">
                                <div>
                                    {{--<input type="file" class="inputFile" name="filepond">--}}
                                    <input type="file" name="image" value="{{$product->image}}" id="imgInp">
                                </div>
                                <div class="mt-4 flex justify-center">

                                    <img src="{{$product->full_image}}" name="image" class="previewImage"
                                         height="auto" width="50%" alt="" id="blah">
                                </div>
                            </div>
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                <div class="col-span-2">
                                    <label for="full_name">{{ __('lang.name') }}</label>
                                    <input type="text" name="name" id="full_name"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                           value="{{$product->name}}"/>
                                </div>

                                <div class="col-span-2">
                                    <label for="price">{{ __('lang.price') }}</label>
                                    <input type="number" name="price" id="price"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                           value="{{$product->price}}"/>
                                </div>
                                <div class="col-span-4">
                                    <label for="address">{{__('lang.description')}}</label>
                                    <textarea name="description" class="w-full bg-gray-50"
                                              rows="5">{{$product->description}}</textarea>
                                </div>
                                <div class="col-span-4 text-right">
                                    <div class="inline-flex items-end">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('lang.submit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <!-- include FilePond library -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <!-- include FilePond plugins -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

    <!-- include FilePond jQuery adapter -->
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <script>
        $(function () {

            // First register any plugins
            $.fn.filepond.registerPlugin(FilePondPluginImagePreview);


            // Turn input element into a pond
            $('.my-pond').filepond();

            // Set allowMultiple property to true
            $('.my-pond').filepond('allowMultiple', true);

            // Listen for addfile event
            $('.my-pond').on('FilePond:addfile', function (e) {
                console.log('file added event', e);
            });

            // Manually add a file using the addfile method
            // $('.my-pond').first().filepond('addFile', 'index.html').then(function(file){
            //     console.log('file added', file);
            // });

        });

        $(document).ready(function () {
            $(".inputFile").change(function () {
                $(".previewImage").hide();
            });
        });

        FilePond.setOptions({
            server: {
                process: '/api/tmp-upload/' + '{{auth()->id()}}',
                headers: {
                    'X-CSRFToken': '{{csrf_token()}}'
                }
            },
        });
    </script>
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
