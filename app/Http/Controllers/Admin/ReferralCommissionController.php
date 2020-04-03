<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReferralCommissionRequest;
use App\Http\Requests\StoreReferralCommissionRequest;
use App\Http\Requests\UpdateReferralCommissionRequest;
use App\ReferralCommission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReferralCommissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('referral_commission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referralCommissions = ReferralCommission::all();

        return view('admin.referralCommissions.index', compact('referralCommissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('referral_commission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referralCommissions.create');
    }

    public function store(StoreReferralCommissionRequest $request)
    {
        $referralCommission = ReferralCommission::create($request->all());

        return redirect()->route('admin.referral-commissions.index');

    }

    public function edit(ReferralCommission $referralCommission)
    {
        abort_if(Gate::denies('referral_commission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referralCommissions.edit', compact('referralCommission'));
    }

    public function update(UpdateReferralCommissionRequest $request, ReferralCommission $referralCommission)
    {
        $referralCommission->update($request->all());

        return redirect()->route('admin.referral-commissions.index');

    }

    public function show(ReferralCommission $referralCommission)
    {
        abort_if(Gate::denies('referral_commission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referralCommissions.show', compact('referralCommission'));
    }

    public function destroy(ReferralCommission $referralCommission)
    {
        abort_if(Gate::denies('referral_commission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referralCommission->delete();

        return back();

    }

    public function massDestroy(MassDestroyReferralCommissionRequest $request)
    {
        ReferralCommission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
