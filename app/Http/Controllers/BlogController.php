<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage blog')) {
            $blogs = Blog::where('parent_id', '=', parentId())->get();
            return view('blog.index', compact('blogs'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        $category = Category::where('parent_id', parentId())->get()->pluck('category', 'id');
        $category->prepend(__('Select Category'), '');

        $status=Blog::$status;
        return view('blog.create', compact('category','status'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create blog')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'category' => 'required',
                    'description' => 'required',
                    'thumbnail' => 'required',
                    'status' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->status = $request->status;
            $blog->category = $request->category;
            $blog->parent_id = parentId();
            if (!empty($request->thumbnail)) {
                $supportFilenameWithExt = $request->thumbnail->getClientOriginalName();
                $supportFilename = pathinfo($supportFilenameWithExt, PATHINFO_FILENAME);
                $supportExtension = $request->thumbnail->getClientOriginalExtension();
                $supportFileName = $supportFilename . '_' . time() . '.' . $supportExtension;
                $dir = storage_path('upload/blog');
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->thumbnail->storeAs('upload/blog/', $supportFileName);
                $blog->thumbnail = $supportFileName;
            }
            $blog->save();
            return redirect()->back()->with('success', __('Blog successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(Blog $blog)
    {
        //
    }


    public function edit(Blog $blog)
    {
        $category = Category::where('parent_id', parentId())->get()->pluck('category', 'id');
        $category->prepend(__('Select Category'), '');

        $status=Blog::$status;
        return view('blog.edit', compact('category','blog','status'));
    }


    public function update(Request $request, Blog $blog)
    {
        if (\Auth::user()->can('edit blog')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'category' => 'required',
                    'description' => 'required',
                    'status' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->status = $request->status;
            $blog->category = $request->category;

            if (!empty($request->thumbnail)) {
                $supportFilenameWithExt = $request->thumbnail->getClientOriginalName();
                $supportFilename = pathinfo($supportFilenameWithExt, PATHINFO_FILENAME);
                $supportExtension = $request->thumbnail->getClientOriginalExtension();
                $supportFileName = $supportFilename . '_' . time() . '.' . $supportExtension;

                $dir = storage_path('upload/blog');

                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->thumbnail->storeAs('upload/blog/', $supportFileName);
                $blog->thumbnail = $supportFileName;
            }
            $blog->save();

            return redirect()->back()->with('success', __('Blog successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(Blog $blog)
    {
        if (\Auth::user()->can('delete blog')) {
            $blog->delete();
            return redirect()->route('blog.index')->with('success', 'Blog successfully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
