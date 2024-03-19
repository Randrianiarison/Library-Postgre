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
                        <a class="nav-link" href="{{ route('emprunt.index') }}">Emprunt</a>
                    </li>
                </ul>
                <form class="d-flex" action="{{ route('livres.search') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Rechercher un livre" aria-label="Search" name="q">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>

            </div>
        </div>
    </nav>

    <main class="container">
        <div class="card-header"><h3>Liste des Livres</h3> </div>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ajouterModal">
            Ajouter
        </button>
        <a class="btn btn-warning" href="{{ route('generate-pdf') }}">PDF</a>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Année de Publication</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($livres as $livre)
                    <tr>
                        <td>{{ $livre->titre }}</td>
                        <td>{{ $livre->auteur }}</td>
                        <td>{{ $livre->genre }}</td>
                        <td>{{ $livre->nombre }}</td>
                        <td>{{ $livre->annee_publication }}</td>
                        <td>{!! (new \Milon\Barcode\DNS1D)->getBarcodeHTML($livre->ISBN, 'PHARMA') !!}
                            P - {{ $livre->ISBN }}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifModal{{ $livre->id }}">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                                <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#emprunt{{ $livre->id }}" data-id="{{ $livre->id }}">
                                    <i class="fas fa-edit"></i> Emprunter
                                </button>


                                <div class="modal fade" id="emprunt{{ $livre->id }}" tabindex="-1" aria-labelledby="empruntLabel{{ $livre->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="empruntLabel{{ $livre->id }}">Emprunter un livre : {{ $livre->titre }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('emprunt.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                                    <div class="mb-3">
                                                        <label for="matricule" class="form-label">Matricule de l'étudiant</label>
                                                        <input type="text" class="form-control" id="matricule" name="matricule" value="{{ old('matricule') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="hidden" class="form-control" id="date_emprunt" name="date_emprunt" value="{{ old('date_emprunt') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date_retour" class="form-label">Date de retour</label>
                                                        <input type="date" class="form-control" id="date_retour" name="date_retour" value="{{ old('date_retour') }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Emprunter</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>

        </div>
        </div>









        <div class="modal fade" id="ajouterModal" tabindex="-1" aria-labelledby="ajouterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterModalLabel">Ajouter un Livre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="titre">Titre :</label>
                            <input type="text" class="form-control" id="titre" name="titre" required>
                        </div>
                        <div class="form-group">
                            <label for="auteur">Auteur :</label>
                            <input type="text" class="form-control" id="auteur" name="auteur" required>
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre :</label>
                            <input type="text" class="form-control" id="genre" name="genre" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre :</label>
                            <input type="number" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="annee_publication">Année de Publication :</label>
                            <input type="text" class="form-control" id="annee_publication" name="annee_publication" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($livres as $livre)
        <div class="modal fade" id="modifModal{{ $livre->id }}" tabindex="-1" aria-labelledby="modifModalLabel{{ $livre->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifModalLabel{{ $livre->id }}">Modifier un Livre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('livres.update', $livre->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="titre">Titre :</label>
                                <input type="text" class="form-control" id="titre" name="titre" value="{{ $livre->titre }}" required>
                            </div>
                            <div class="form-group">
                                <label for="auteur">Auteur :</label>
                                <input type="text" class="form-control" id="auteur" name="auteur" value="{{ $livre->auteur }}" required>
                            </div>
                            <div class="form-group">
                                <label for="genre">Genre :</label>
                                <input type="text" class="form-control" id="genre" name="genre" value="{{ $livre->genre }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre :</label>
                                <input type="number" class="form-control" id="nombre" name="nombre"value="{{ $livre->nombre }}" required>
                            </div>
                            <div class="form-group">
                                <label for="annee_publication">Année de Publication :</label>
                                <input type="text" class="form-control" id="annee_publication" name="annee_publication" value="{{ $livre->annee_publication }}" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="ISBN" name="ISBN" value="{{ $livre->ISBN }}" required>
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


    </main>

@endsection

