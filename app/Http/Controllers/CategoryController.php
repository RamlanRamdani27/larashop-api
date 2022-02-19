<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\Categories as CategoryResourceCollection;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $crieteria = Category::paginate(6);
        return new CategoryResourceCollection($crieteria);
    }

    public function slug($slug)
    {
        $criteria = Category::where('slug', $slug)->first();
        return new CategoryResource($criteria);
    }

    public function random($count)
    {
        $criteria = Category::select('*')
            ->inRandomOrder()
            ->limit($count)
            ->get();
        return new CategoryResourceCollection($criteria);
    }
}
