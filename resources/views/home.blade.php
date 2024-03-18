@extends('layouts.app')

@section('content')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        body {
            margin-top: 3pc;
        }
    </style>

    </style>

    <link href="offcanvas.css" rel="stylesheet">
    </head>
    <body class="bg-light">

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
        <div class="container-fluid">
            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etudiants.index') }}">Etudiant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('livre.index') }}">Livres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" >Emprunt</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <main class="container">

    </main>

@endsection
