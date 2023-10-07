<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row pb-4 mb-4">
                <div class="max-w-xxl p-6 bg-white rounded-lg shadow-md flex-1 mx-2 w-auto">
                    @if (session('success'))
                        <div class="w-full bg-green-500 text-center rounded-xl opacity-70">
                            <p class="px-3 py-3 text-white" role="alert" id="session-alert">{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('permdelete'))
                        <div class="w-full bg-red-500 text-center rounded-xl opacity-70">
                            <p class="px-3 py-3 text-white" role="alert" id="session-alert">
                                {{ session('permdelete') }}
                            </p>
                        </div>
                    @endif
                    <h5 class="text-md font-semibold mb-4">{{ $title }}</h5>
                    <table class="w-full whitespace-no-wrap bg-white shadow-md rounded table-auto">
                        <thead>
                            <tr class="text-left font-semibold">
                                <th class="px-6 py-3 bg-blue-400 rounded-tl-md">SL No</th>
                                <th class="px-6 py-3 bg-blue-400 ">Brand Name</th>
                                <th class="px-6 py-3 bg-blue-400 ">Brand Image</th>
                                <th class="px-6 py-3 bg-blue-400">Created At</th>
                                <th class="px-6 py-3 bg-blue-400 text-center rounded-tr-md">Action</th>
                            </tr>
                        </thead>
                        @foreach ($brands as $data)
                            <tbody>
                                <tr class="hover:bg-gray-300 rounded-b-md">
                                    <td class="px-6 py-4">{{ $brands->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-4">{{ $data->brand_name }}</td>
                                    <td class="px-6 py-4"><img src="{{ asset($data->brand_image) }}" alt=""
                                            class="w-[120px] h-[160px] ">
                                    </td>
                                    {{-- * Query Builder --}}
                                    {{-- <td class="px-6 py-4"> {{ $data->name }}</td> --}}
                                    {{-- * Other Part --}}
                                    <td class="px-6 py-4">
                                        @if ($data->created_at === null)
                                            <span class="text-red-600">No Data Set</span>
                                        @else
                                            {{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    {{-- * <td class="px-6 py-4">{{ $data->created_at->diffForHumans() }}</td> --}}
                                    <td class="px-1 py-4 justify-center">
                                        <a href="{{ url('brand/edit/' . $data->id) }}"
                                            class="py-2 px-2 bg-blue-400 text-decoration-none text-black rounded-md mr-2">Edit</a>
                                        <a href="{{ url('brand/softdelete/' . $data->id) }}"
                                            class="py-2 px-2 bg-red-400 text-decoration-none text-black rounded-md">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="px-2 py-2">
                    {{ $brands->links() }}
                </div>
                <div class="max-w-md p-6 bg-white rounded-lg shadow-md flex-1 mx-2 w-auto h-1/2">
                    <h5 class="text-md font-semibold mb-4">Add Category</h5>
                    <hr>
                    <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data"
                        class="w-full">
                        @csrf
                        <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 text-s font-bold mb-2" for="category-name">
                                Brand Name
                            </label>
                            <input
                                class="appearance-none block  @error('brand_name') border-red-600 border-2 @enderror w-full text-black-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white "
                                id="brand-name" type="text" name="brand_name" placeholder="Enter the name">
                            @error('brand_name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-full px-3 py-2 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 text-s font-bold mb-2" for="category-name">
                                Brand Image
                            </label>
                            <input
                                class="block w-full text-sm text-black-900 @error('brand_image') border-red-600 border-2 @enderror rounded-lg cursor-pointer bg-sky-50 dark:text-sky-400 focus:outline-none dark:bg-sky-700 dark:border-sky-600 dark:placeholder-sky-400 py-2 px-1"
                                id="file_input" type="file" name="brand_image">
                            @error('brand_image')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
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
