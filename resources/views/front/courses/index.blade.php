@extends('layouts.front')
@section('content')
    <main>

        @include('front.partials.breadcrumbs', ['breadcrumbs' => [
            ['name' => __('home.home'), 'link' => route('front.home')],
            ['name' => __('course.сourses')],
        ]])

        @if(count($courses) > 0)
            <section class="container">
                <div class="grid">
                    <div class="row">
                        @foreach($courses as $course)
                            <div class="col-xs-6 col-md-4">
                                @include('front.courses._item', ['course' => $course])
                            </div>
                        @endforeach
                    </div>

                    {{ $courses->links('front.partials.paginator') }}

                </div>
            </section>
        @else
            <section class="container no-search">
                <div class="title-section">{{ __('course.not_found_available_courses') }}</div>
            </section>
        @endif

    </main>
@endsection

@section('scripts')
    @parent
@endsection
