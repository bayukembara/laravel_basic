<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row pb-4 mb-4">
                <div class="max-w-xxl p-6 bg-white rounded-lg shadow-md flex-1 mx-2 w-auto h-auto">
                    @if (session('success'))
                        <div class="w-full bg-green-500 text-center rounded-xl opacity-70">
                            <p class="px-3 py-3 text-white" role="alert" id="session-alert">{{ session('success') }}</p>
                        </div>
                    @endif
                    <h5 class="text-md font-semibold mb-4">All Brands</h5>
                    <table class="w-full whitespace-no-wrap bg-white shadow-md rounded table-auto">
                        <thead>
                            <tr class="text-left font-semibold">
                                <th class="px-6 py-3 bg-blue-400 rounded-tl-md">SL No</th>
                                <th class="px-6 py-3 bg-blue-400 ">Brand Name</th>
                                <th class="px-6 py-3 bg-blue-400 w-1/4">Brand Image</th>
                                <th class="px-6 py-3 bg-blue-400 ">Created At</th>
                                <th class="px-6 py-3 bg-blue-400 rounded-tr-md text-center">Action</th>
                            </tr>
                        </thead>
                        {{-- @php($i = 1) --}}
                        @foreach ($brand as $data)
                            <tbody>
                                <tr class="hover:bg-gray-300 rounded-b-md">
                                    <td class="px-6 py-4">{{ $brand->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-4">{{ $data->brand_name }}</td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset($data->brand_image) }}" alt="{{ $data->brand_image }}"
                                            class="w-full h-full">
                                    </td>
                                    {{-- <td class="px-6 py-4">{{ $data->name }}</td> --}}
                                    <td class="px-6 py-4">
                                        @if ($data->created_at === null)
                                            <span class="text-red-600">No Data Set</span>
                                        @else
                                            {{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    {{-- * <td class="px-6 py-4">{{ $data->created_at->diffForHumans() }}</td> --}}
                                    <td>
                                        <div class="flex align-middle justify-center mx-2">
                                            <a href="{{ route('edit.brand', ['id' => $data->id]) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-gray-300 hover:text-white px-3 py-2 mr-1 rounded-xl no-underline">Edit</a>
                                            <a href="{{ route('delete.brand', ['id' => $data->id]) }}"
                                                class="bg-red-500 hover:bg-red-700 text-gray-300 hover:text-white px-3 py-2 ml-1 rounded-xl no-underline"onclick="return confirm('Are you sure?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    {{ $brand->links() }}
                </div>
                <div class="max-w-md p-6 bg-white rounded-lg shadow-md flex-1 mx-2 w-auto h-50">
                    <h5 class="text-md font-semibold mb-4">Add Brand</h5>
                    <hr>
                    <form action="{{ route('store.brand') }}" method="POST" class="w-full"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                            <div class="mb-3">
                                <label class="block tracking-wide text-gray-700 teweb.xt-s font-bold mb-2"
                                    for="brand-name">
                                    Brand Name
                                </label>
                                <input
                                    class="appearance-none block @error('brand_name') border-red-600 border-2 @enderror w-full text-black-700 rounded py-3 px-3 leading-tight focus:outline-none focus:bg-white"
                                    id="brand-name" type="text" name="brand_name" placeholder="Enter the name">
                                @error('brand_name')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="block tracking-wide text-gray-700 text-s font-bold mb-2"
                                    for="brand-image">
                                    Brand Image
                                </label>
                                <input
                                    class="w-full px-3 py-2 rounded border border-solid border-1 border-black @error('brand_image') border-red-600 @enderror"
                                    id="brand-image" type="file" name="brand_image" placeholder="Enter the name">
                                @error('brand_image')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-full px-3 mt-2 md:mb-0">
                            <button
                                class="block py-2 px-2 bg-blue-300 rounded-md hover:bg-blue-400 hover:rounded-lg focus:border-blue-700"
                                type="submit">Add
                                Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
