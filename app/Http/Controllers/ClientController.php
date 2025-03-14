<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage client')) {
            $clients = User::where('parent_id', parentId())->where('type', 'client')->get();
            return view('client.index', compact('clients'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

    }


    public function create()
    {
        return view('client.create');
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create user')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ids = parentId();
            $authUser = \App\Models\User::find($ids);
            $total_client = $authUser->totalClient();
            $subscription = Subscription::find($authUser->subscription);
            if ($total_client < $subscription->total_client || $subscription->total_client == 0) {
                $role_r = Role::where('parent_id',parentId())->where('name','client')->first();
                $client = new User();
                $client->name = $request->name;
                $client->email = $request->email;
                $client->phone_number = $request->phone_number;
                $client->password = \Hash::make($request->password);
                $client->type = 'client';
                $client->profile = 'avatar.png';
                $client->lang = 'english';
                $client->parent_id = parentId();
                $client->save();
                $client->assignRole($role_r);

                return redirect()->route('clients.index')->with('success', __('Client successfully created.'));

            } else {
                return redirect()->back()->with('error', __('Your client limit is over, Please upgrade your subscription.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $client=User::find($id);
        return view('client.edit',compact('client'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit client')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id,
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $client=User::find($id);
            $client->name = $request->name;
            $client->email = $request->email;
            $client->phone_number = $request->phone_number;
            $client->save();
            return redirect()->route('clients.index')->with('success', __('Client successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {

        if (\Auth::user()->can('delete client') ) {
            $user = User::find($id);
            $user->delete();

            return redirect()->route('clients.index')->with('success', __('Client successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
