@extends('layouts.front')
@section('content')
    <main>
        <section class="container white">
            <div class="contacte">
                <div class="title-section">{{ __('main.contacts') }}</div>
                <div class="row">

                    <div class=" col-sm-12 col-md-7">
                        <div class="contact-box">
                            <div class="row">

                                <div class="contact-left col-xs-6 col-md-5">
                                    <div class="item">
                                        <div class="label">
                                            {{ $settings[localeAppColumn('address')] }}
                                            <br>
                                            {{ __('contact.phone_fax') }}: {{ $settings['phone_fax'] }}
                                            <br> {{ $settings['email'] }}
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label">{{ __('contact.work_schedule') }}:</div>
                                        <div class="text">
                                            {{ $settings['work_time'] }}
                                            <br>
                                            {{ $settings['lunch_break'] }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">{{ __('contact.training_and_research_department') }}</div>
                                        <div class="text">{{ __('main.tel') }}: {{ $settings['training_and_research_department_phone'] }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">{{ __('contact.initial_training_section') }}</div>
                                        <div class="text">{{ __('main.tel') }}: {{ $settings['initial_training_section_phone'] }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">{{ __('contact.continuing_education_section') }}</div>
                                        <div class="text">{{ __('main.tel') }}: {{ $settings['continuing_education_section_phone'] }}</div>
                                    </div>
                                </div>

                                <div class="contact-right col-xs-6 col-md-7">
                                    <div class="item">
                                        <div class="label">{{ __('contact.didactic_methodical_section') }}</div>
                                        <div class="text">{{ __('main.tel') }}: {{ $settings['didactic_methodical_section_phone'] }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">{{ __('contact.e_training_section') }}</div>
                                        <div class="text">{{ __('main.tel') }}: {{ $settings['e_training_section_phone'] }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">{{ __('contact.e_training_section') }}</div>
                                        <div class="text">
                                            {{ __('main.mob') }}: {{ $settings['information_technology_department_phone_mob'] }}
                                            <br>
                                            {{ __('main.tel') }}: {{ $settings['information_technology_department_phone'] }}
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label">{{ __('contact.international_relations_section') }}</div>
                                        <div class="text">{{ __('main.tel') }}: {{ $settings['international_relations_section_phone'] }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-5">
                        <div class="contact-form">
                            <form action="{{ route('contacts.send') }}" method="post">
                                @csrf
                                <span class="full-input">
                                    <label for="">{{ __('main.fist_and_last_name') }}</label>
                                    <input type="text" name="name" value="{{ auth()->user() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : '' }}">
                                </span>
                                <span class="full-input">
                                    <label for="">{{ __('main.email') }}</label>
                                    <input name="email" type="email">
                                </span>
                                <span class="full-input">
                                    <label for="">{{ __('main.phone') }}</label>
                                    <input type="tel" name="phone">
                                </span>
                                <span class="full-input">
                                    <label for="">{{ __('main.message') }}</label>
                                    <textarea name="message" placeholder="{{ __('contact.enter_your_message') }}"></textarea>
                                </span>
                                @if(session()->has('message'))
                                    <div class="full-input no-search" style="width: 100%; background: #d5f5d5; padding: 25px 40px; color: #026402; text-align: center; margin-bottom: 15px;">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div id="send-errors" class="full-input no-search" style="{{ $errors->any() ? '' : 'display: none;' }} background: #F8E4E5; padding: 25px 40px; color: #970C13; width: 100%; text-align: center; margin-bottom: 15px;">
                                    @if($errors->any())
                                        {!! implode('', $errors->all('<strong>:message</strong><br>')) !!}
                                    @endif
                                </div>
                                <span class="full-input">
                                    <input class="button" type="submit" value="{{ __('contact.submit') }}">
                                </span>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2719.7874533767736!2d28.81595401585719!3d47.024776935980306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c97dce76542abf%3A0x5dbe07fe1f4dffb7!2zU3RyYWRhIFNlcmdoZWkgTGF6byAxLCBDaGnImWluxIN1IDIwMDQsINCc0L7Qu9C00LDQstC40Y8!5e0!3m2!1sru!2s!4v1596018747538!5m2!1sru!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    @parent
@endsection
