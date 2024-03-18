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
                        <a class="nav-link" href="{{ route('auteurs.index') }}">Auteurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" >Categorie</a>
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

        <div class="container">
            <h1>Liste des Auteurs</h1>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ajouterModal">
                Ajouter
            </button>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Biographie</th>
                </tr>
                </thead>
                <tbody>
                @foreach($auteur as $auteur)
                    <tr>
                        <td>{{ $auteur->nom }}</td>
                        <td>{{ $auteur->prenom }}</td>
                        <td>{{ $auteur->dateN }}</td>
                        <td>{{ $auteur->biographie }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>



    </main>

    <div class="modal fade" id="ajouterModal" tabindex="-1" aria-labelledby="ajouterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterModalLabel">Ajouter un Cours</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('auteurs.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="form-group">
                            <label for="dateN">Date de Naissance :</label>
                            <input type="date" class="form-control" id="dateN" name="dateN" required>
                        </div>
                        <div class="form-group">
                            <label for="biographie">Biographie :</label>
                            <textarea class="form-control" id="biographie" name="biographie" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

