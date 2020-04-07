<?php

namespace App\Http\Controllers\Admin;

use App\EmailSubscription;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmailSubscriptionRequest;
use App\Http\Requests\StoreEmailSubscriptionRequest;
use App\Http\Requests\UpdateEmailSubscriptionRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmailSubscriptionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('email_subscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EmailSubscription::query()->select(sprintf('%s.*', (new EmailSubscription)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'email_subscription_show';
                $editGate      = 'email_subscription_edit';
                $deleteGate    = 'email_subscription_delete';
                $crudRoutePart = 'email-subscriptions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('email_address', function ($row) {
                return $row->email_address ? $row->email_address : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? EmailSubscription::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.emailSubscriptions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('email_subscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emailSubscriptions.create');
    }

    public function store(StoreEmailSubscriptionRequest $request)
    {
        $emailSubscription = EmailSubscription::create($request->all());

        return redirect()->route('admin.email-subscriptions.index');

    }

    public function edit(EmailSubscription $emailSubscription)
    {
        abort_if(Gate::denies('email_subscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emailSubscriptions.edit', compact('emailSubscription'));
    }

    public function update(UpdateEmailSubscriptionRequest $request, EmailSubscription $emailSubscription)
    {
        $emailSubscription->update($request->all());

        return redirect()->route('admin.email-subscriptions.index');

    }

    public function show(EmailSubscription $emailSubscription)
    {
        abort_if(Gate::denies('email_subscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emailSubscriptions.show', compact('emailSubscription'));
    }

    public function destroy(EmailSubscription $emailSubscription)
    {
        abort_if(Gate::denies('email_subscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emailSubscription->delete();

        return back();

    }

    public function massDestroy(MassDestroyEmailSubscriptionRequest $request)
    {
        EmailSubscription::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
