<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            All Category</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row pb-4 mb-4">
                <div class="max-w-md p-6 bg-white rounded-lg shadow-md flex-1 mx-2 w-auto h-1/2">
                    <h5 class="text-md font-semibold mb-4">Update Category</h5>
                    <hr>
                    {{-- & this ORM Edit --}}
                    {{-- * dalam route kita bisa memasukan parameter('nama_route',id) kedua itu dibutuhkan untuk mendapatkan id agar dapat disimpan --}}
                    <form action="{{ url('category/update/' . $categories->id) }}" method="POST" class="w-full">
                        @csrf
                        <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 text-s font-bold mb-2" for="category-name">
                                Category Name
                            </label>
                            <input
                                class="appearance-none block  @error('category_name') border-red-600 border-2 @enderror w-full text-black-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white "
                                id="category-name" type="text" name="category_name" placeholder="Enter the name"
                                value="{{ $categories->category_name }}">
                            @error('category_name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-full px-3 mt-2 md:mb-0">
                            <button
                                class="block py-2 px-2 bg-blue-300 rounded-md hover:bg-blue-400 hover:rounded-lg focus:border-blue-700"
                                type="submit">Update
                                Category</button>
                        </div>
                    </form>
                    {{-- * <form action="{{ route('update.category', $categories->id) }}" method="POST" class="w-full">
                        @csrf
                        <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 text-s font-bold mb-2" for="category-name">
                                Category Name
                            </label>
                            <input
                                class="appearance-none block  @error('category_name') border-red-600 border-2 @enderror w-full text-black-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white "
                                id="category-name" type="text" name="category_name" placeholder="Enter the name"
                                value="{{ $categories->category_name }}">
                            @error('category_name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-full px-3 mt-2 md:mb-0">
                            <button
                                class="block py-2 px-2 bg-blue-300 rounded-md hover:bg-blue-400 hover:rounded-lg focus:border-blue-700"
                                type="submit">Update
                                Category</button>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
