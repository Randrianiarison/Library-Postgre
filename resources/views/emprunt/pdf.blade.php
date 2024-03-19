<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>{{$title}}</title>
</head>
<body>
<h1>Title : {{$title}}</h1>
<h>Date : {{$date}}</h>



<main class="container">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th>Identifiant de l'étudiant</th>
                <th>Titre du livre</th>
                <th>Date d'emprunt</th>
                <th>Date de retour</th>
            </tr>
            </thead>
            <tbody>
            @foreach($livre as $emprunt)
                <tr>
                    <td>{{ $emprunt->idEtudiant }}</td>
                    <td>{{ $emprunt->titre_livre }}</td>
                    <td>{{ $emprunt->dateEmp }}</td>
                    <td>{{ $emprunt->dateRetour }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>
