<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
use App\Models\KnowledgeArticle;
use App\Models\Notification;
use App\Models\Support;
use App\Models\SupportFile;
use App\Models\SupportReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SupportController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage ticket')) {
            if (\Auth::user()->type == 'client') {
                $supports = Support::where('client', \Auth::user()->id)->get();
            } else {
                $supports = Support::where('parent_id', parentId())->orWhere('assignment', parentId())->get();
            }
            return view('support.index', compact('supports'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        $users = User::where('parent_id', parentId())->where('type', '!=', 'client')->get()->pluck('name', 'id');
        $users->prepend(__('Select User'), '');

        $clients = User::where('parent_id', parentId())->where('type', 'client')->get()->pluck('name', 'id');
        $clients->prepend(__('Select User'), '');

        $importance = Support::$importance;
        $stage = Support::$stage;

        $category = Category::where('parent_id', parentId())->get()->pluck('category', 'id');
        $category->prepend(__('Select Category'), '');
        return view('support.create', compact('users', 'importance', 'stage', 'clients', 'category'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create ticket')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'client' => 'required',
                    'assignment' => 'required',
                    'headline' => 'required',
                    'importance' => 'required',
                    'stage' => 'required',
                    'category' => 'required',
                    'summary' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $support = new Support();
            $support->support_id = $this->ticketNumber();
            $support->client = $request->client;
            $support->assignment = $request->assignment;
            $support->headline = $request->headline;
            $support->importance = $request->importance;
            $support->stage = $request->stage;
            $support->category = $request->category;
            $support->summary = $request->summary;
            $support->created_id = \Auth::user()->id;
            $support->parent_id = parentId();
            $support->save();

            if (!empty($request->attachment)) {
                foreach ($request->attachment as $attachment) {
                    $supportAttechmentnameWithExt = $attachment->getClientOriginalName();
                    $supportAttechmentname = pathinfo($supportAttechmentnameWithExt, PATHINFO_FILENAME);
                    $supportExtension = $attachment->getClientOriginalExtension();
                    $supportAttechmentName = $supportAttechmentname . '_' . time() . '.' . $supportExtension;
                    $directory = storage_path('upload/support');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $attachment->storeAs('upload/support/', $supportAttechmentName);
                    $supportAttechment = new SupportFile();
                    $supportAttechment->support_id = $support->id;
                    $supportAttechment->reply_id = 0;
                    $supportAttechment->files = $supportAttechmentName;
                    $supportAttechment->parent_id = parentId();
                    $supportAttechment->save();
                }
            }


            $module = 'ticket_create';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $support->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['password'] = $request->password;
                $data['logo'] = $setting['company_logo'];
                $to = $support->clients->email;

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }

            $module = 'ticket_assignment';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $support->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['password'] = $request->password;
                $data['logo'] = $setting['company_logo'];
                $to = $support->assignments->email;

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }

            return redirect()->back()->with('success', __('Ticket successfully created.') . '<br>' . $errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show($ids)
    {
        if (\Auth::user()->can('reply ticket')) {
            $id = Crypt::decrypt($ids);
            $support = Support::find($id);

            return view('support.show', compact('support'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function edit($id)
    {
        if (\Auth::user()->can('edit ticket')) {
            $support = Support::find($id);
            $users = User::where('parent_id', parentId())->where('type', '!=', 'client')->get()->pluck('name', 'id');
            $users->prepend(__('Select User'), '');

            $clients = User::where('parent_id', parentId())->where('type', 'client')->get()->pluck('name', 'id');
            $clients->prepend(__('Select User'), '');

            $importance = Support::$importance;
            $stage = Support::$stage;

            $category = Category::where('parent_id', parentId())->get()->pluck('category', 'id');
            $category->prepend(__('Select Category'), '');
            return view('support.edit', compact('users', 'importance', 'stage', 'support', 'clients', 'category'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function update(Request $request, $id)
    {

        if (\Auth::user()->can('edit ticket')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'client' => 'required',
                    'assignment' => 'required',
                    'headline' => 'required',
                    'importance' => 'required',
                    'stage' => 'required',
                    'category' => 'required',
                    'summary' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $support = Support::find($id);
            $support->client = $request->client;
            $support->assignment = $request->assignment;
            $support->headline = $request->headline;
            $support->importance = $request->importance;
            $support->stage = $request->stage;
            $support->category = $request->category;
            $support->summary = $request->summary;
            $support->save();

            return redirect()->back()->with('success', __('Ticket successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete ticket')) {
            $support = Support::find($id);

            SupportReply::where('support_id', $support->id)->delete();
            SupportFile::where('support_id', $support->id)->delete();
            $support->delete();

            return redirect()->route('ticket.index')->with('success', 'Ticket successfully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function reply(Request $request, $id)
    {
        if (\Auth::user()->can('reply ticket')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'comment' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $supportReply = new SupportReply();
            $supportReply->support_id = $id;
            $supportReply->user_id = \Auth::user()->id;
            $supportReply->description = $request->comment;
            $supportReply->parent_id = parentId();
            $supportReply->save();

            if (!empty($request->attachment)) {
                foreach ($request->attachment as $attachment) {
                    $supportAttechmentnameWithExt = $attachment->getClientOriginalName();
                    $supportAttechmentname = pathinfo($supportAttechmentnameWithExt, PATHINFO_FILENAME);
                    $supportExtension = $attachment->getClientOriginalExtension();
                    $supportAttechmentName = $supportAttechmentname . '_' . time() . '.' . $supportExtension;
                    $directory = storage_path('upload/support');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $attachment->storeAs('upload/support/', $supportAttechmentName);
                    $supportAttechment = new SupportFile();
                    $supportAttechment->support_id = $id;
                    $supportAttechment->reply_id = $supportReply->id;
                    $supportAttechment->files = $supportAttechmentName;
                    $supportAttechment->parent_id = parentId();
                    $supportAttechment->save();
                }
            }

            $supportTicket = $supportReply->supportTicket;
            $assiger_id = $supportTicket->client == \Auth::user()->id ? $supportTicket->assignment : $supportTicket->client;
            $assiger = User::find($assiger_id);
            $errorMessage = '';
            if(!empty($assiger->email)) {
                $module = 'ticket_assignment_update';
                $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
                $setting = settings();
                if (!empty($notification) && $notification->enabled_email == 1) {
                    $notification_responce = MessageReplace($notification, $supportReply->id);
                    $data['subject'] = $notification_responce['subject'];
                    $data['message'] = $notification_responce['message'];
                    $data['module'] = $module;
                    $data['password'] = $request->password;
                    $data['logo'] = $setting['company_logo'];
                    $to = $assiger->email;

                    $response = commonEmailSend($to, $data);
                    if ($response['status'] == 'error') {
                        $errorMessage = '</br><span class="text-danger">'.$response['message'].'</span>';
                    }
                }
            }

            return redirect()->back()->with('success', __('Ticket reply successfully send.').$errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function ticketNumber()
    {
        $lastTicket = Support::where('parent_id', parentId())->latest()->first();
        if ($lastTicket == null) {
            return 1;
        } else {
            return $lastTicket->support_id + 1;
        }
    }

    public function ticketNumbers($id)
    {
        $lastTicket = Support::where('parent_id', $id)->latest()->first();
        if ($lastTicket == null) {
            return 1;
        } else {
            return $lastTicket->support_id + 1;
        }
    }

    public function todayTicket()
    {
        if (\Auth::user()->can('manage ticket')) {
            $supports = Support::whereDate('created_at', date('Y-m-d'))
                ->where(function ($query) {
                    $query->where('parent_id', parentId())->orWhere('assignment', parentId());
                });
            $supports = $supports->get();

            return view('support.today', compact('supports'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function ticket($code)
    {
        $user = User::where('code', $code)->first();
        $id = !empty($user) ? $user->id : 0;
        \App::setLocale(!empty($user) ? $user->lang : 'english');

        $settings = settingsById($id);
        $faqs = Faq::where('parent_id', $id)->where('status', 1)->get();
        $articles = KnowledgeArticle::where('parent_id', $id)->get();
        $blogs = Blog::where('parent_id', $id)->where('status', 1)->get();
        $category = Category::where('parent_id', $id)->get()->pluck('category', 'id');
        $category->prepend(__('Select Category'), '');
        $importance = Support::$importance;
        return view('frontend.index', compact('settings', 'code', 'faqs', 'articles', 'id', 'blogs', 'category', 'importance'));
    }


    public function ticketStore(Request $request, $code)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'headline' => 'required',
                'importance' => 'required',
                'category' => 'required',
                'summary' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first())->withInput();
        }

        $user = User::where('code', $code)->first();
        $userRole = Role::where('name', 'client')->where('parent_id', $user->id)->first();
        $client = new User();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = \Hash::make($request->password);;
        $client->type = 'client';
        $client->profile = 'avatar.png';
        $client->lang = 'english';
        $client->email_verified_at = now();
        $client->parent_id = $user->id;
        $client->save();
        $client->assignRole($userRole);

        $support = new Support();
        $support->support_id = $this->ticketNumbers($user->id);
        $support->headline = $request->headline;
        $support->client = $client->id;
        $support->assignment = 0;
        $support->importance = $request->importance;
        $support->stage = 'pending';
        $support->category = $request->category;
        $support->summary = $request->summary;
        $support->created_id = $client->id;
        $support->parent_id = $user->id;
        $support->save();

        if (!empty($request->attachment)) {
            foreach ($request->attachment as $attachment) {
                $supportAttechmentnameWithExt = $attachment->getClientOriginalName();
                $supportAttechmentname = pathinfo($supportAttechmentnameWithExt, PATHINFO_FILENAME);
                $supportExtension = $attachment->getClientOriginalExtension();
                $supportAttechmentName = $supportAttechmentname . '_' . time() . '.' . $supportExtension;
                $directory = storage_path('upload/support');
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                $attachment->storeAs('upload/support/', $supportAttechmentName);
                $supportAttechment = new SupportFile();
                $supportAttechment->support_id = $support->id;
                $supportAttechment->reply_id = 0;
                $supportAttechment->files = $supportAttechmentName;
                $supportAttechment->parent_id = $user->id;
                $supportAttechment->save();
            }
        }

        $module = 'ticket_create';
        $notification = Notification::where('parent_id', $user->id)->where('module', $module)->first();
        $setting = settings();
        $errorMessage = '';
        if (!empty($notification) && $notification->enabled_email == 1) {
            $notification_responce = MessageReplace($notification, $support->id);
            $data['subject'] = $notification_responce['subject'];
            $data['message'] = $notification_responce['message'];
            $data['module'] = $module;
            $data['password'] = $request->password;
            $data['parent_id'] = $user->id;
            $data['logo'] = $setting['company_logo'];
            $to = $support->clients->email;

            $response = commonEmailSend($to, $data);
            if ($response['status'] == 'error') {
                $errorMessage = '</br><span class="text-danger">'.$response['message'].'</span>';
            }
        }

        return redirect()->back()->with('success', __('Ticket successfully created.') .  $errorMessage);
    }
}
