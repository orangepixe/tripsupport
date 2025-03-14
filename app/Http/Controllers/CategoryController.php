<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage category') ) {
            $categories = Category::where('parent_id', '=', parentId())->get();
            return view('category.index', compact('categories'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        return view('category.create');
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create category') ) {
            $validator = \Validator::make(
                $request->all(), [
                    'category' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $category = new Category();
            $category->category = $request->category;
            $category->parent_id = parentId();
            $category->save();

            return redirect()->back()->with('success', __('Category successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        if (\Auth::user()->can('edit category') ) {
            $validator = \Validator::make(
                $request->all(), [
                    'category' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $category->category = $request->category;
            $category->save();

            return redirect()->back()->with('success', __('Category successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(Category $category)
    {
        if (\Auth::user()->can('delete category') ) {
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category successfully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
