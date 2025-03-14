<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage owner faq')) {
            $faqs = Faq::where('parent_id', '=', parentId())->get();
            return view('faqs.index', compact('faqs'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        $status=Faq::$status;
        return view('faqs.create',compact('status'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create owner faq')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'description' => 'required',
                    'status' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $faq = new Faq();
            $faq->title = $request->title;
            $faq->description = $request->description;
            $faq->status = $request->status;
            $faq->parent_id = parentId();
            $faq->save();

            return redirect()->back()->with('success', __('FAQ successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(Faq $faq)
    {
        //
    }


    public function edit(Faq $faq)
    {
        $status=Faq::$status;
        return view('faqs.edit',compact('faq','status'));
    }


    public function update(Request $request, Faq $faq)
    {
        if (\Auth::user()->can('edit owner faq')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'description' => 'required',
                    'status' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $faq->title = $request->title;
            $faq->description = $request->description;
            $faq->status = $request->status;
            $faq->save();

            return redirect()->back()->with('success', __('FAQ successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(Faq $faq)
    {
        if (\Auth::user()->can('delete owner faq')) {
            $faq->delete();
            return redirect()->route('faqs.index')->with('success', 'FAQ successfully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
