<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="/adn.svg">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: #65A43D;
            font-family: 'Nunito';
            color: white;
        }

        .head{
            text-align: right
            }
        .head2{
            text-align: left
        }
        .logo{
                max-width: 150px;
            }
        .adnlogo{
            width: 30%;
        }
        .logos{
            width: 40%;
        }
        .aslogo{
            width: 15%;
        }

        @media (min-width: 1200px) {
            .logo{
                max-width: 150px;
            }
            
        }

        /* Portrait tablet to landscape and desktop */
        @media (min-width: 768px) and (max-width: 979px) {
            .logo{
                max-width: 75px;
            }
        }

        /* Landscape phone to portrait tablet */
        @media (max-width: 767px) {
            .logo{
                max-width: 75px;
            }
            .adnlogo{
                width: 80%;
            }
            .logos{
                width: 100%;
            }
            .aslogo{
                width: 60%;
            }
        }

        /* Landscape phones and down */
        @media (max-width: 480px) {
            .logo{
                max-width: 75px;
            }
        }

    </style>
</head>
<body>
    <div id="app">
        <div style="text-align: right" class="col-md-12 col-sm-12  mb-3">
        <button type="button" class="btn btn-outline-dark"><b><a style="text-decoration: none;color:white!important" class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a></b></button>
        </div>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-sm-12 text-center mb-3">
                        <img class="logos" src="/logoAs.png" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 text-center ">
                        <h2><b>Accès à la plateforme</b></h2>
                    </div>
                    <div class="col-md-8 col-sm-12 text-center">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row justify-content-center">
                                <div class="col-md-6">
                                    <input id="name" type="text" placeholder="Nom*" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group  row justify-content-center">
                                <div class="col-md-6">
                                    <input id="prenom" type="text" placeholder="Prenom*" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                                    @error('prenom')
                                        <span style="color: #FFA900!important" class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group  row justify-content-center">
                                <div class="col-md-6">
                                    <input id="email" onkeyup="this.value = this.value.toLowerCase();"  placeholder="e-mail*" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span style="color: #FFA900!important" class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col-md-6">
                                    <input id="email-confirm" onkeyup="this.value = this.value.toLowerCase();"  placeholder="Confirm e-mail*" type="email" class="form-control" name="email_confirmation" required autocomplete="new-email">
                                </div>
                            </div>

                            <div class="form-group  row justify-content-center">
                                <div class="col-md-6">
                                    <input id="specialite" type="text" placeholder="Specialite*" class="form-control @error('specialite') is-invalid @enderror" name="specialite" value="{{ old('specialite') }}" required autocomplete="specialite" autofocus>
                                    @error('specialite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group  row justify-content-center">  
                                <div class="col-md-6">
                                    <input id="ville" type="text" placeholder="Ville*" class="form-control @error('ville') is-invalid @enderror" name="ville" value="{{ old('ville') }}" required autocomplete="ville" autofocus>
                                    @error('ville')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group  row justify-content-center">
                                <div class="col-md-6">
                                    <input id="gsm" type="text" placeholder="GSM" class="form-control @error('gsm') is-invalid @enderror" name="gsm" value="{{ old('gsm') }}" autocomplete="gsm" autofocus>
                                    @error('gsm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group  row justify-content-center">
                                <div class="col-md-6 ">
                                    <p style="color: white"><b>Diplômé(e) en diabétologie ?:</b></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="secteur" value="oui" id="secteur1" required>
                                        <label class="form-check-label" for="secteur1">
                                          OUI
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="secteur" value="non" id="secteur2" required>
                                        <label class="form-check-label" for="secteur2">
                                          NON
                                        </label>
                                    </div>
                                    @error('gsm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('S\'inscrire') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-sm-12 text-center mb-3">
                        <img class="aslogo" src="/ascrea.png" alt="">
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>


