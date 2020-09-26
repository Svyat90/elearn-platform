@extends('layouts.front')
@section('content')
    <main>

        <section class="container account">
            <div class="title-section">{{ __('profile.my_account') }}</div>
            <div class="row">

                @include('front.partials.navigationProfile')

                <div class="account-content white col-xs-9">
                    <div class="grid">
                        <div class="title">Main information</div>

                        <form class="user-detail" action="">
                            <span class="row-input">
                                <label for="">Nume</label>
                                <input type="text" value="Alexei">
                            </span>

                            <span class="row-input">
                                <label for="">Prenume</label>
                                <input type="text" value="Gamurari">
                            </span>

                            <span class="row-input">
                                <label for="">E-mail</label>
                                <input type="email">
                            </span>

                            <span class="row-input">
                                <label for="">Telefon</label>
                                <input type="tel">
                            </span>

                            <span class="row-input">
                                <label for="">Insitut</label>
                                <select name="" id="">
                                    <option value="" selected>Institutul national al justitiei</option>
                                    <option value="">Institutul national al justitiei</option>
                                    <option value="">Institutul national al justitiei</option>
                                </select>
                            </span>

                            <span class="row-input">
                                <label for="">Functia</label>
                                <input type="text">
                            </span>

                            <span class="full-input right">
                                <input type="submit" class="button" value="Save changes" disabled>
                            </span>
                        </form>

                        <div class="title">Parola</div>

                        <form class="user-password" action="">
                            <span class="row-input password-input">
                                <label for="">Old password</label>
                                <span class="show"></span>
                                <input class="password" type="password" value="123456789">
                            </span>

                            <span class="row-input password-input">
                                <label for="">New password</label>
                                <span class="show"></span>
                                <input class="password" type="password">
                            </span>

                            <span class="full-input right">
                                <input type="submit" class="button" value="Save changes">
                            </span>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('scripts')
    @parent
@endsection
