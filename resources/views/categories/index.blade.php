<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flow-root mb-3">
                <div class="inline-flex float-right shadow-sm sm:rounded-lg mb-3"></div>
                <a href="{{route('categories.create')}}" class="bg-blue-600 hover:bg-blue-800 text-gray-200 hover:text-gray-100 text-sm font-medium py-2 px-4 rounded float-right">
                    New Category
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        # of Books
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="#8f8f8f">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$category->name}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                        {{$category->books_count ?? 0}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Available
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <!-- <a href="{{route('categories.edit', 1)}}"    class="inline-flex items-center h-8 px-4 ml-2 text-sm text-gray-100 transition-colors duration-150 bg-gray-500 rounded focus:shadow-outline hover:bg-gray-800">View</a> -->
                                        <!-- <a href="{{route('categories.show', 1)}}"    class="inline-flex items-center h-8 px-4 ml-2 text-sm text-gray-100 transition-colors duration-150 bg-gray-500 rounded focus:shadow-outline hover:bg-gray-800">Edit</a> -->
                                        <!-- <a href="{{route('categories.destroy', 1)}}" class="inline-flex items-center h-8 px-4 ml-2 text-sm text-red-100 transition-colors duration-150 bg-red-500 rounded focus:shadow-outline hover:bg-red-800">Delete</a> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</x-app-layout>
