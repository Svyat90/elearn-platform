@extends('layouts.front')
@section('content')
    <main>

        <section class="container account">
            <div class="title-section">{{ __('profile.my_account') }}</div>
            <div class="row">

                @include('front.partials.navigationProfile')

                <div class="account-content white col-xs-9">
                    @if(count($documents) > 0)
                        <div class="grid">
                            <div class="title">{{ $title }}</div>
                            <div class="row">
                                @foreach($documents as $document)
                                    <div class="col-xs-6 col-md-4">
                                        @include('front.documents._item', ['document' => $document])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="no-content">
                            <div>
                                <div class="title-section">{{ __('profile.you_dont_have_any_documents') }}</div>
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
