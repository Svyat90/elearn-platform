<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\EmailSubscription;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmailSubscriptionRequest;
use App\Http\Requests\UpdateEmailSubscriptionRequest;
use App\Http\Resources\Admin\EmailSubscriptionResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailSubscriptionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('email_subscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmailSubscriptionResource(EmailSubscription::all());

    }

    public function store(StoreEmailSubscriptionRequest $request)
    {
        $emailSubscription = EmailSubscription::create($request->all());

        return (new EmailSubscriptionResource($emailSubscription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(EmailSubscription $emailSubscription)
    {
        abort_if(Gate::denies('email_subscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmailSubscriptionResource($emailSubscription);

    }

    public function update(UpdateEmailSubscriptionRequest $request, EmailSubscription $emailSubscription)
    {
        $emailSubscription->update($request->all());

        return (new EmailSubscriptionResource($emailSubscription))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(EmailSubscription $emailSubscription)
    {
        abort_if(Gate::denies('email_subscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emailSubscription->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
