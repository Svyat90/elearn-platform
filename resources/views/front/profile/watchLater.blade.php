@extends('layouts.front')
@section('content')
    <main>

        <section class="container account">
            <div class="title-section">{{ __('profile.my_account') }}</div>
            <div class="row">

                @include('front.partials.navigationProfile')

                <div class="account-content white col-xs-9">

                        <div class="grid">
                            <div class="title">{{ __('main.documents') }}</div>
                            <div class="row">
                                @if(count($documents) > 0)
                                    @foreach($documents as $document)
                                        <div class="col-xs-6 col-md-4">
                                            @include('front.documents._item', ['document' => $document])
                                        </div>
                                    @endforeach
                                @else
                                    <div class="" style="margin-left: 20px;">{{ __('profile.you_dont_have_any_watch_later_documents') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="grid">
                            <div class="title">{{ __('main.сourses') }}</div>
                            <div class="row">
                                @if(count($courses) > 0)
                                    @foreach($courses as $course)
                                        <div class="col-md-6">
                                            @include('front.courses._item', ['course' => $course])
                                        </div>
                                    @endforeach
                                @else
                                    <div class="" style="margin-left: 20px;">{{ __('profile.you_dont_have_any_watch_later_courses') }}</div>
                                @endif
                            </div>
                        </div>

                </div>
            </div>
        </section>

    </main>
@endsection

@section('scripts')
    @parent
@endsection
