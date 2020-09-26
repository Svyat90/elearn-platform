@extends('layouts.front')
@section('content')
    <main>

        <section class="container account">
            <div class="title-section">{{ __('profile.my_account') }}</div>
            <div class="row">

                @include('front.partials.navigationProfile')

                <div class="account-content white col-xs-9">
                    @if(count($courses) > 0)
                        <div class="grid">
                            <div class="title">{{ __('profile.my_courses') }}</div>
                            <div class="row">
                                @foreach($courses as $course)
                                    <div class="col-md-6">
                                        @include('front.courses._item', ['course' => $course])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="no-content">
                            <div>
                                <div class="title-section">{{ __('profile.you_dont_have_any_courses') }}</div>
                                <a href="{{ route('courses.index') }}" class="button-white">+ {{ __('profile.add_courses') }}</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>

    </main>
@endsection

@section('scripts')
    @parent
@endsection
