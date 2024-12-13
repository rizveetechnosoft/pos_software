<?php

namespace Modules\Superadmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Superadmin\Entities\Subscription;

use App\Business;
use App\User;
use Illuminate\Support\Facades\DB;

use Modules\Superadmin\Notifications\SuperadminCommunicator;
use Modules\Superadmin\Entities\SuperadminCommunicatorLog;

use Yajra\DataTables\Facades\DataTables;

use Carbon\Carbon;

class AffiliateController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $businesses = Business::orderby('name')
            ->pluck('name', 'id');

        $promoterCount = User::where('user_type', 'promoter')->count();

        $total_amount = DB::table('subscriptions')
            ->join('business', 'business.id', '=', 'subscriptions.business_id')
            ->join('users', 'users.id', '=', 'business.owner_id')
            ->whereNotNull('users.referrer_id')
            ->select('subscriptions.package_price')
            ->sum('subscriptions.package_price');

        $currentMonth = Carbon::now()->format('Y-m');
        $monthly_amount = DB::table('subscriptions')
            ->join('business', 'business.id', '=', 'subscriptions.business_id')
            ->join('users', 'users.id', '=', 'business.owner_id')
            ->whereNotNull('users.referrer_id')
            ->whereMonth('subscriptions.created_at', '=', Carbon::now()->month)
            ->whereYear('subscriptions.created_at', '=', Carbon::now()->year)
            ->sum('subscriptions.package_price');

        $monthly_collection = number_format($monthly_amount, 0, '.', ' ') . ' tk';
        $total_affiliate_amount = number_format($total_amount, 0, '.', ' ') . ' tk';

        $affiliate_percentage = 15;
        $affiliate_amount = ($total_amount * $affiliate_percentage) / 100;
        $payable_amount = number_format($affiliate_amount, 0, '.', ' ') . ' tk';

        return view('superadmin::affiliate.index')
            ->with(compact('businesses', 'promoterCount', 'monthly_collection', 'total_affiliate_amount', 'payable_amount'));
    }

    public function getPromotter()
    {

        $info = User::select('users.id', 'users.first_name', 'users.user_type', 'users.username', 'users.pass_show', 'users.contact_number', 'users.click_count')
            ->where('users.user_type', 'promoter')
            ->withCount('referrals')
            ->get();

        return Datatables::of($info)
            ->addColumn('action', function ($info) {
                $html = '';
                $html .= ' <a href="' . action('\Modules\Superadmin\Http\Controllers\AffiliateController@viewReffer', $info->id) . '"
                            class="btn btn-primary btn-sm">' . __('View Referrer Information') . '</a>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function viewReffer(Request $request)
    {
        $promotter_id = $request->id;

        return view('superadmin::affiliate.reffer_list',compact('promotter_id'));
    }

    public function getReffer($promotter_id)
    {

        $info = Business::select('users.id', 'users.first_name', 'users.email', 'business.start_date', 'users.referrer_id', 'business.name')
            ->leftJoin('users', 'business.owner_id', '=', 'users.id')
            ->where('users.referrer_id', $promotter_id)
            ->get();

        return Datatables::of($info)
            ->rawColumns(['action'])
            ->make(true);
    }
}
