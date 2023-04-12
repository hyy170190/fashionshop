<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //view category
    public function createPage()
    {
        return view('admin.category.create');
    }

    //create category and put in database
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = [
            'name' => $request->name
        ];
        Category::create($data);
        return redirect()->route('category#list');
    }

    //category list page
    public function list()
    {
        $categories = Category::paginate(5);
        return view('admin.category.list', compact('categories'));
    }

    //category edit page
    public function editPage($id)
    {
        $data = Category::where('id',$id)->first();
        return view('admin.category.edit', compact('data'));
    }

    //edit and update category
    public function edit($id, Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = [
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ];
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list');
    }

    //category delete
    public function delete($id)
    {
        $data = Category::where('id',$id);
        $data->delete();

        return redirect()->route('category#list');
    }

    //category validation
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories,name'
        ])->validate();
    }
}
