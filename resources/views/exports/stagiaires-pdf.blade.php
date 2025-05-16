<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Stagiaires</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            width: 100%;
        }
        .header {
            text-align: center;
            color: #f97316;
            margin-bottom: 2px;
            margin-top: 2px;
        }
        table {
            border-collapse: collapse;
            margin-bottom: 2px;
            width: 100%;
        }
        th {
            background-color: #f97316;
            color: white;
            padding: 2px;
            text-align: left;
        }
        td {
            padding: 2px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Liste des Stagiaires</h1>
        <p>Généré le {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Carte d'Identité</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Type de Stage</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Date de Naissance</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stagiaires as $stagiaire)
            <tr>
                <td>{{ $stagiaire->prenom }}</td>
                <td>{{ $stagiaire->nom }}</td>
                <td>{{ $stagiaire->CIN }}</td>
                <td>{{ $stagiaire->email }}</td>
                <td>{{ $stagiaire->tel }}</td>
                <td>{{ $stagiaire->typeStage->type ?? '-' }}</td>
                <td>{{ $stagiaire->debut ? $stagiaire->debut->format('d/m/Y') : '-' }}</td>
                <td>{{ $stagiaire->fin ? $stagiaire->fin->format('d/m/Y') : '-' }}</td>
                <td>{{ $stagiaire->date_naissance ? $stagiaire->date_naissance->format('d/m/Y') : '-' }}</td>
                <td>{{ $stagiaire->genre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 