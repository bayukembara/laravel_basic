<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hi.. <b>{{ Auth::user()->name }}</b>
            <b class="float-right"> Total Users <span
                    class="bg-sky-100 text-sky-800 text-m font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-sky-200 dark:text-sky-300">{{ count($users) }}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap bg-white shadow-md rounded table-auto">
                    <thead>
                        <tr class="text-left font-semibold">
                            <th class="px-6 py-3 bg-blue-400 rounded-tl-md">SL No</th>
                            <th class="px-6 py-3 bg-blue-400 ">Name</th>
                            <th class="px-6 py-3 bg-blue-400 ">Email</th>
                            <th class="px-6 py-3 bg-blue-400 rounded-tr-md">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($users as $data)
                            <tr class="hover:bg-gray-300 border-b-black">
                                <td class="px-6 py-4">{{ $i++ }}</td>
                                <td class="px-6 py-4">{{ $data->name }}</td>
                                <td class="px-6 py-4">{{ $data->email }}</td>
                                {{-- <td class="px-6 py-4">{{ $data->created_at->diffForHumans() }}</td> --}}
                                <td class="px-6 py-4">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
