<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row pb-4 mb-4">
                <div class="max-w-md p-6 bg-white rounded-lg shadow-md flex-1 mx-2 w-auto">
                    <h5 class="text-md font-semibold mb-4">Edit brands</h5>
                    <hr>
                    <form action="{{ route('update.brand',['id'=>$brands->id]) }}" method="POST"
                        enctype="multipart/form-data" class="w-full">
                        @csrf
                        <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                        <div class=" w-full md:w-full px-3 mb-6 md:mb-2">
                            <label class="block tracking-wide text-gray-700 text-s font-bold mb-2" for="category-name">
                                Brand Name
                            </label>
                            <input
                                class="appearance-none block  @error('brand_name') border-red-600 border-2 @enderror w-full text-black-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white "
                                id="brand-name" type="text" name="brand_name" value="{{ $brands->brand_name }}">
                            @error('brand_name')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-full px-3 mb-6 md:mb-2">
                            <label class="block tracking-wide text-gray-700 text-s font-bold mb-2" for="brand-name">
                                Brand Image
                            </label>
                            <input type="file"
                                class="w-full block border-dashed border-1 border-black px-2 py-2 rounded"
                                name="brand_image" value="{{ $brands->brand_image }}">
                            @error('brand_image')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-full px-3 mb-6 rounded">
                            <img src="{{ asset($brands->brand_image) }}" class="w-1/2 h-1/2 rounded" alt="">
                        </div>
                        <div class="w-full md:w-full px-3 mt-2 md:mb-0">
                            <button
                                class="block py-2 px-2 bg-blue-300 rounded-md hover:bg-blue-400 hover:rounded-lg focus:border-blue-700"
                                type="submit">Edit
                                Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>