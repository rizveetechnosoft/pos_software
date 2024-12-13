<?php

namespace Modules\Superadmin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Superadmin\Entities\SuperadminNotice;

class SuperadminNoticeController extends Controller
{
  
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $notice_message = SuperadminNotice::firstOrCreate(['id' => 1]);

        return view('superadmin::superadmin_notice.edit', compact('notice_message'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $notice_message = SuperadminNotice::first();
        $notice_message->notice_message = $request->notice_message;
        $notice_message->save();

        $output = ['success' => 1, 'msg' => __('lang_v1.success')];

        return redirect()
        ->action([\Modules\Superadmin\Http\Controllers\SuperadminNoticeController::class, 'edit' ])
        ->with('status', $output);
    }

  
}
