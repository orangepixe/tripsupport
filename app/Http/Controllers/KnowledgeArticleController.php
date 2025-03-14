<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\KnowledgeArticle;
use Illuminate\Http\Request;

class KnowledgeArticleController extends Controller
{

    public function index()
    {

        if (\Auth::user()->can('manage knowledge article')) {
            $knowledges = KnowledgeArticle::where('parent_id', '=', parentId())->get();
            return view('knowledge.index', compact('knowledges'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        $category = Category::where('parent_id', parentId())->get()->pluck('category', 'id');
        $category->prepend(__('Select Category'), '');

        return view('knowledge.create', compact('category'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create knowledge article')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'category' => 'required',
                    'description' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $knowledgeArticle = new KnowledgeArticle();
            $knowledgeArticle->title = $request->title;
            $knowledgeArticle->description = $request->description;
            $knowledgeArticle->category = $request->category;
            $knowledgeArticle->parent_id = parentId();
            $knowledgeArticle->save();
            return redirect()->back()->with('success', __('Knowledge article successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(KnowledgeArticle $knowledgeArticle)
    {
        //
    }


    public function edit(KnowledgeArticle $knowledgeArticle)
    {
        $category = Category::where('parent_id', parentId())->get()->pluck('category', 'id');
        $category->prepend(__('Select Category'), '');

        return view('knowledge.edit', compact('category','knowledgeArticle'));
    }


    public function update(Request $request, KnowledgeArticle $knowledgeArticle)
    {
        if (\Auth::user()->can('edit knowledge article')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'category' => 'required',
                    'description' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $knowledgeArticle->title = $request->title;
            $knowledgeArticle->description = $request->description;
            $knowledgeArticle->category = $request->category;
            $knowledgeArticle->save();
            return redirect()->back()->with('success', __('Knowledge article successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(KnowledgeArticle $knowledgeArticle)
    {
        if (\Auth::user()->can('delete knowledge article')) {
            $knowledgeArticle->delete();
            return redirect()->back()->with('success', 'Knowledge article successfully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
