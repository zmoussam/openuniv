<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationLog;
use App\Models\Order;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use App\Constants\Status;
use App\Models\Product;
use App\Models\ProductDetail;

class ReportController extends Controller
{
    public function loginHistory(Request $request)
    {
        $pageTitle = 'User Login History';
        $loginLogs = UserLogin::orderBy('id','desc')->searchable(['user:username'])->with('user')->paginate(getPaginate());
        return view('admin.reports.logins', compact('pageTitle', 'loginLogs'));
    }

    public function loginIpHistory($ip)
    {
        $pageTitle = 'Login by - ' . $ip;
        $loginLogs = UserLogin::where('user_ip',$ip)->orderBy('id','desc')->with('user')->paginate(getPaginate());
        return view('admin.reports.logins', compact('pageTitle', 'loginLogs','ip'));
    }

    public function notificationHistory(Request $request){
        $pageTitle = 'Notification History';
        $logs = NotificationLog::orderBy('id','desc')->searchable(['user:username'])->with('user')->paginate(getPaginate());
        return view('admin.reports.notification_history', compact('pageTitle','logs'));
    }

    public function emailDetails($id){
        $pageTitle = 'Email Details';
        $email = NotificationLog::findOrFail($id);
        return view('admin.reports.email_details', compact('pageTitle','email'));
    }

    public function orderHistory(Request $request){ 
        $pageTitle = 'Order History';

        $orders = Order::searchable(['user:username', 'deposit:trx'])
            ->filter(['status'])
            ->dateFilter()
            ->orderBy('id','desc')
            ->with('user', 'deposit', 'orderItems')
        ->paginate(getPaginate());

        return view('admin.reports.order_history', compact('pageTitle', 'orders'));
    }
 
    public function orderDetails($id){ 
        $order = Order::findOrFail($id);
        $pageTitle = "Order Details - {$order->deposit->trx}";

        $items = @$order->orderItems->pluck('product_detail_id')->toArray() ?? [];
        $accounts = ProductDetail::whereIn('id', $items)->searchable(['details'])->orderBy('id', 'DESC')->paginate(getPaginate());
        
        return view('admin.product.account',compact('pageTitle', 'accounts', 'order'));
    }

}


