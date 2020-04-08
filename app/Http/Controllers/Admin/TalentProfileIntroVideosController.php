<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TalentProfileIntroVideosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('talent_profile_intro_video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.talentProfileIntroVideos.index');
    }
}
