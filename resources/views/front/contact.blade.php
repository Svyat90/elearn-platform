@extends('layouts.front')
@section('content')
    <main>
        <section class="container white">
            <div class="contacte">
                <div class="title-section">Contacte</div>
                <div class="row">

                    <div class=" col-sm-12 col-md-7">
                        <div class="contact-box">
                            <div class="row">

                                <div class="contact-left col-xs-6 col-md-5">
                                    <div class="item">
                                        <div class="label">MD-2004, Republica Moldova <br> Chișinău, str. S.Lazo, 1 <br> Tel/fax: (+373 22) 232 755 <br> e-mail:inj@inj.gov.md</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Program de lucru:</div>
                                        <div class="text">luni-vineri: 8.00-17.00, <br> pauză de masă: 12.00-13.00</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Direcția instruire și cercetare</div>
                                        <div class="text">Tel: (+373 22) 233 483</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Secția instruire inițială</div>
                                        <div class="text">Tel: (+373 22) 228 186</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Secția instruire continuă</div>
                                        <div class="text">Tel: (+373 22) 930 115</div>
                                    </div>
                                </div>

                                <div class="contact-right col-xs-6 col-md-7">
                                    <div class="item">
                                        <div class="label">Secția didactico-metodică și formare formatori</div>
                                        <div class="text">Tel: (+373 22) 930 114 / 233 068</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Secția e-instruire</div>
                                        <div class="text">Tel: (+373 22) 930 124</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Secția tehnologii informaționale</div>
                                        <div class="text">Mob: (+373 68) 185 791 <br> Tel: (+373 22) 930 124</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Secția relații internaționale</div>
                                        <div class="text">Tel: (+373 22) 930 221</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-5">
                        <div class="contact-form">
                            <form action="">
                 <span class="full-input">
                  <label for="">Nume si prenume</label>
                  <input type="text" value="Alexei">
                </span>
                                <span class="full-input">
                  <label for="">E-mail</label>
                  <input type="email">
                </span>
                                <span class="full-input">
                  <label for="">Telefon</label>
                  <input type="tel">
                </span>
                                <span class="full-input">
                  <label for="">Message</label>
                  <textarea placeholder="Type tour message..."></textarea>
                </span>
                                <span class="full-input">
                  <input class="button" type="submit" value="Transmite">
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
