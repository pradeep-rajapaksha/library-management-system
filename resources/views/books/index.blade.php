<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flow-root mb-3">
                <div class="inline-flex float-left sm:rounded-lg mb-3">
                    <form action="" method="GET" class="flex items-baseline">
                        <input type="text" name="query" id="query" autocomplete="off" value="{{old('query') ?? request()->get('query')}}" class="inline-flex mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <button class="inline-flex items-center py-2 px-4 ml-2 text-sm font-medium text-gray-200 transition-colors duration-150 bg-blue-600 rounded focus:shadow-outline hover:bg-blue-800" type="submit">Search</button>
                    </form>
                </div>
                <a href="{{route('books.create')}}" class="bg-blue-600 hover:bg-blue-800 text-gray-200 hover:text-gray-100 text-sm font-medium py-2 px-4 rounded float-right">
                    New Book
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
                                                Title / ISBN
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Category / Type
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Author
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Price
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
                                        @foreach($books as $book)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="#8f8f8f">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                            </svg>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{$book->title}}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                ISBN-{{$book->isbn}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @foreach($book->categories as $category)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            {{$category->name}}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    @foreach($book->authors as $author)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            {{ucfirst($author->title)}} {{$author->first_name}} {{$author->last_name}}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{number_format($book->price, 2)}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @if($book->status == true)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Available
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Unavailable
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{route('books.show', $book->id)}}"    class="inline-flex items-center h-8 px-4 ml-2 text-sm text-gray-100 transition-colors duration-150 bg-gray-500 rounded focus:shadow-outline hover:bg-gray-800">View</a>
                                                    <a href="{{route('books.edit', $book->id)}}"    class="inline-flex items-center h-8 px-4 ml-2 text-sm text-gray-100 transition-colors duration-150 bg-gray-500 rounded focus:shadow-outline hover:bg-gray-800">Edit</a>
                                                    <form action="{{route('books.destroy', $book->id)}}" class="inline" method="POST">
                                                        @method('DELETE') @csrf
                                                        <button class="inline-flex items-center h-8 px-4 ml-2 text-sm text-red-100 transition-colors duration-150 bg-red-500 rounded focus:shadow-outline hover:bg-red-800" type="submit">Delete</button>
                                                    </form>
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
            <div class="bg-transparent overflow-hidden mt-4">
                <div class="col">
                    {{$books->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
