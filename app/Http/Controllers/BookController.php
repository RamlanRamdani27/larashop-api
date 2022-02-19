<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Books as BookResourceCollection;

class BookController extends Controller
{
    public function index()
    {
        $crieteria = Book::paginate(6);
        return new BookResourceCollection($crieteria);
    }

    public function slug($slug)
    {
        $crieteria = Book::where('slug', $slug)->first();
        $crieteria->views = $crieteria->views + 1;
        $crieteria->save();
        return new BookResource($crieteria);
    }

    public function top($count)
    {
        $crieteria = Book::select('*')
            ->orderBy('views', 'DESC')
            ->limit($count)
            ->get();
        return new BookResourceCollection($crieteria);
    }

    public function search($keyword)
    {
        $crieteria = Book::select('*')
            ->where('title', 'LIKE', "%" . $keyword . "%")
            ->orderBy('views', 'DESC')
            ->get();
        return new BookResourceCollection($crieteria);
    }
}
