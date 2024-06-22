<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get(Category $category) {
        $this->successResponse();




    }


    public function index() {

    }
}
