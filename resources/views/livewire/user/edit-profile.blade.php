<div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form wire:submit.prevent="submit">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <label class="block text-sm font-medium text-gray-700">{{ __('lang.avatar') }}</label>
                                <input type="file"
                                       class="filepond w-32"
                                       name="avatar"
                                       accept="image/png, image/jpeg, image/gif"/>
                            </div>
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">First
                                        name</label>
                                    <input type="text" name="name" id="name" autocomplete="given-name"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="surname" class="block text-sm font-medium text-gray-700">Last
                                        name</label>
                                    <input type="text" name="surname" id="surname" autocomplete="family-name"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email-address" class="block text-sm font-medium text-gray-700">Email
                                        address</label>
                                    <input type="text" name="email-address" id="email-address" autocomplete="email"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="col-span-6">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="tel" name="phone" id="phone"
                                           autocomplete="tel"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div wire:ignore wire:key="document1" class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="region" class="block text-sm font-medium text-gray-700">
                                        Select CNIC
                                    </label>
                                    <input type="file"
                                           class="filepond mt-1"
                                           name="document1"
                                           data-allow-reorder="true"
                                           data-max-file-size="3MB"
                                           data-max-files="3">
                                </div>

                                <div  wire:ignore wire:key="document2" class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700">
                                        Select Passport
                                    </label>
                                    <input type="file"
                                           class="filepond mt-1"
                                           name="document2"
                                           data-allow-reorder="true"
                                           data-max-file-size="3MB"
                                           data-max-files="3">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @once
        <x-forms.filepond
                :element="'document1'"
                :source-image="auth()->user()->document1_path"
                :wire-model="'document1'"
        />
        <x-forms.filepond
                :element="'document2'"
                :source-image="auth()->user()->document2_path"
                :wire-model="'document2'"
        />
        <script>
            const avatarImage = '{{auth()->user()->avatar_path}}';
            const avatarEl = document.querySelector('input[name="avatar"]');

            FilePond.create(avatarEl,
                {
                    server: {
                        process: '/pond',
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
                        source: avatarImage,
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
    @endonce
@endpush