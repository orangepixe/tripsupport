<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Custom;
use App\Models\FAQ;
use App\Models\HomePage;
use App\Models\NoticeBoard;
use App\Models\PackageTransaction;
use App\Models\Page;
use App\Models\Subscription;
use App\Models\Support;
use App\Models\User;
use Carbon\Carbon;




class HomeController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            if (\Auth::user()->type == 'super admin') {
                $result['totalOrganization'] = User::where('type', 'owner')->count();
                $result['totalSubscription'] = Subscription::count();
                $result['totalTransaction'] = PackageTransaction::count();
                $result['totalIncome'] = PackageTransaction::sum('amount');
                $result['totalNote'] = NoticeBoard::where('parent_id', parentId())->count();
                $result['totalContact'] = Contact::where('parent_id', parentId())->count();

                $result['organizationByMonth'] = $this->organizationByMonth();
                $result['paymentByMonth'] = $this->paymentByMonth();

                return view('dashboard.super_admin', compact('result'));
            } else {
                if(\Auth::user()->type=='client'){
                    $result['totalTicket'] = Support::where('client', \Auth::user()->id)->count();
                    $result['todayTicket'] = Support::whereDate('created_at', '=', date('Y-m-d'))->where('client', \Auth::user()->id)->count();
                    $result['settings']=settings();
                    $result['tickets']=$this->getTickets();
                }else{
                    $result['totalUser'] = User::where('parent_id', parentId())->where('type','!=','client')->count();
                    $result['totalClient'] = User::where('parent_id', parentId())->where('type','client')->count();
                    $result['totalTicket'] = Support::where('created_id', parentId())->orWhere('assignment', parentId())->count();
                    $result['todayTicket'] = Support::whereDate('created_at', '=', date('Y-m-d'))->where('created_id', parentId())->orWhere('assignment', parentId())->count();
                    $result['settings']=settings();
                    $result['tickets']=$this->getTickets();
                }

                return view('dashboard.index', compact('result'));
            }
        } else {
            if (!file_exists(setup())) {
                header('location:install');
                die;
            } else {

                $landingPage = getSettingsValByName('landing_page');
                if ($landingPage == 'on') {
                    $subscriptions = Subscription::get();
                    $menus = Page::where('enabled', 1)->get();
                    $FAQs = FAQ::where('enabled', 1)->get();
                    return view('layouts.landing', compact('subscriptions', 'menus', 'FAQs'));
                } else {
                    return redirect()->route('login');
                }
            }
        }
    }

    public function organizationByMonth()
    {
        $start = strtotime(date('Y-01'));
        $end = strtotime(date('Y-12'));

        $currentdate = $start;

        $organization = [];
        while ($currentdate <= $end) {
            $organization['label'][] = date('M-Y', $currentdate);

            $month = date('m', $currentdate);
            $year = date('Y', $currentdate);
            $organization['data'][] = User::where('type', 'owner')->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
            $currentdate = strtotime('+1 month', $currentdate);
        }


        return $organization;
    }

    public function paymentByMonth()
    {
        $start = strtotime(date('Y-01'));
        $end = strtotime(date('Y-12'));

        $currentdate = $start;

        $payment = [];
        while ($currentdate <= $end) {
            $payment['label'][] = date('M-Y', $currentdate);

            $month = date('m', $currentdate);
            $year = date('Y', $currentdate);
            $payment['data'][] = PackageTransaction::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('amount');
            $currentdate = strtotime('+1 month', $currentdate);
        }

        return $payment;
    }

    public function getTickets()
    {
        $arrDuration = [];
        $previous_week = strtotime("-2 week +1 day");
        for ($i = 0; $i < 14; $i++) {
            $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
            $previous_week = strtotime(date('Y-m-d', $previous_week) . " +1 day");
        }

        $arrTask = [];
        $arrTask['label'] = [];
        $arrTask['data'] = [];
        foreach ($arrDuration as $date => $label) {

            $data = Support::where('parent_id', parentId())->whereDate('created_at', $date)->count();
            $arrTask['label'][] = $label;
            $arrTask['data'][] = $data;
        }

        return $arrTask;
    }
}
