<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $books = \App\Models\Book::with('categories')->with('authors');
        
        if($request->has('query') And !empty($request->get('query'))) {
            $keyword = $request->get('query');
            $books->where(function($q) use($keyword) {
                $q->where('title', 'like', '%'.$keyword.'%')
                    ->orWhereHas('categories', function($q) use($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('authors', function($q) use($keyword) {
                        $q->where('first_name', 'like', '%' . $keyword . '%');
                        $q->orWhere('last_name', 'like', '%' . $keyword . '%');
                    });
            });
        }
        $books = $books->where('status', true)->paginate(8);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Models\Category::pluck('name', 'id'); 
        $authors = \App\Models\Author::select(\DB::raw("CONCAT(title,'.',CONCAT(first_name,' ',last_name)) AS name"), 'id')->pluck('name', 'id');
        // dd($authors);
        return view('books.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'isbn'       => 'required|numeric|unique:books',
            'title'      => 'required',
            'categories' => 'required',
            'authors'    => 'required',
            'price'      => 'required',
            'status'     => 'required',
        ]);

        $book = new \App\Models\Book();
            $book->isbn        = $request->isbn;
            $book->title       = $request->title;
            $book->price       = $request->price;
            $book->status      = $request->status;

        if($book->save()) {
            $book->categories()->attach($request->categories);
            $book->authors()->attach($request->authors);

            return redirect()->route('books.index')->with('status', 'Book created!');
        }
        return redirect()->back()->withInput()->with('status', 'Book create falied!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('books.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $book = \App\Models\Book::findOrFail($id);
        $categories = \App\Models\Category::pluck('name', 'id'); 
        $authors = \App\Models\Author::select(\DB::raw("CONCAT(title,'.',CONCAT(first_name,' ',last_name)) AS name"), 'id')->pluck('name', 'id');
        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'isbn'       => 'required|numeric|unique:books,id,'.$id,
            'title'      => 'required',
            'categories' => 'required',
            'authors'    => 'required',
            'price'      => 'required',
            'status'     => 'required',
        ]);

        $book = \App\Models\Book::findOrFail($id);
            $book->isbn        = $request->isbn;
            $book->title       = $request->title;
            $book->price       = $request->price;
            $book->status      = $request->status;

        if($book->save()) {
            $book->categories()->sync($request->categories);
            $book->authors()->sync($request->authors);

            return redirect()->route('books.index')->with('status', 'Book updated!');
        }
        return redirect()->back()->withInput()->with('status', 'Book update falied!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = \App\Models\Book::findOrFail($id);

        // $categories = $book->categories;
        // $authors = $book->authors;
        
        if($book->delete()) {
            $book->categories()->detach($book->categories);
            $book->authors()->detach($book->authors);

            return redirect()->route('books.index')->with('status', 'Book deleted!');
        }
        return redirect()->back()->withInput()->with('status', 'Book delete falied!');
    }
}
