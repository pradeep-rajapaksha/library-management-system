<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flow-root mb-3">
                <div class="inline-flex float-right shadow-sm sm:rounded-lg mb-3"></div>
                <a href="{{route('books.index')}}" class="bg-gray-600 hover:bg-gray-800 text-gray-200 hover:text-gray-100 text-sm font-medium py-2 px-4 rounded float-right">
                    Books
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form action="{{route('books.store')}}" method="POST">
                                        @csrf
                                        <div class="shadow overflow-hidden sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN *</label>
                                                        <input type="number" name="isbn" id="isbn" autocomplete="off" value="{{old('isbn')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('isbn') <div class="error text-sm text-red-500">{{ $message }}</div> @enderror
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                                                        <input type="text" name="title" id="title" autocomplete="off" value="{{old('title')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('title') <div class="error text-sm text-red-500">{{ $message }}</div> @enderror
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="categories" class="block text-sm font-medium text-gray-700">Category / Type *</label>
                                                        <select id="categories" name="categories[]" autocomplete="off" multiple="multiple" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            @foreach($categories as $key => $category)
                                                                <option value="{{$key}}">{{$category}}</option>
                                                            @endforeach
                                                            <!-- <option value="new" onclick="alert('init: add new category')">Add new category</option> -->
                                                        </select>
                                                        @error('categories') <div class="error text-sm text-red-500">{{ $message }}</div> @enderror
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="authors" class="block text-sm font-medium text-gray-700">Author *</label>
                                                        <select id="authors" name="authors[]" autocomplete="off" multiple class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            @foreach($authors as $key => $author)
                                                                <option value="{{$key}}">{{ucfirst($author)}}</option>
                                                            @endforeach
                                                            <!-- <option value="new" onclick="alert('init: add new author')">Add new author</option> -->
                                                        </select>
                                                        @error('authors') <div class="error text-sm text-red-500">{{ $message }}</div> @enderror
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="price" class="block text-sm font-medium text-gray-700">Price *</label>
                                                        <input type="number" name="price" id="price" autocomplete="off" step="0.01" value="{{old('price')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('price') <div class="error text-sm text-red-500">{{ $message }}</div> @enderror
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="status" class="block text-sm font-medium text-gray-700">Availability</label>
                                                        <select id="status" name="status" autocomplete="off" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="1" {{old('status') == 1 ? 'selected' : ''}}>Available</option>
                                                            <option value="0" {{old('status') == 0 ? 'selected' : ''}}>Unavailable</option>
                                                        </select>
                                                        @error('price') <div class="error text-sm text-red-500">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
</x-app-layout>
