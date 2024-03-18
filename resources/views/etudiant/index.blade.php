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

        <div class="container">
            <h1>Liste des Étudiants</h1>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ajouterModal">
                Ajouter
            </button>



            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Département</th>
                    <th>Matricule</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($etudiant as $etud)
                    <tr>
                        <td>{{ $etud->nom }}</td>
                        <td>{{ $etud->prenom }}</td>
                        <td>{{ $etud->email }}</td>
                        <td>{{ $etud->departement }}</td>
                        <td>{{ $etud->matricule }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifModal{{ $etud->id }}">
                                Modifier
                            </button>
                            <form action="{{ route('utilisateurs.destroy', ['utilisateur' => $etud->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
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
                    <h5 class="modal-title" id="ajouterModalLabel">Ajouter Utilisateurs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('utilisateurs.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom :</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="departement">Département :</label>
                                <input type="text" class="form-control" id="departement" name="departement" required>
                            </div>
                            <div class="form-group">
                                <label for="matricule">Matricule :</label>
                                <input type="text" class="form-control" id="matricule" name="matricule" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach($etudiant as $etud)
        <div class="modal fade" id="modifModal{{ $etud->id }}" tabindex="-1" aria-labelledby="modifModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifModalLabel">Modifier un Étudiant</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('utilisateurs.update', ['user' => $etud->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $etud->nom }}" required>
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom :</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $etud->prenom }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $etud->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="departement">Département :</label>
                                <input type="text" class="form-control" id="departement" name="departement" value="{{ $etud->departement }}" required>
                            </div>
                            <div class="form-group">
                                <label for="matricule">Matricule :</label>
                                <input type="text" class="form-control" id="matricule" name="matricule" value="{{ $etud->matricule }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection

