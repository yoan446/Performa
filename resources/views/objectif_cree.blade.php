<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mail</title>
</head>
<body>
    <h2>Nouvel Objectif Assigné</h2>
    <p><strong>Titre :</strong> {{ $objectif->titre }}</p>
    <p><strong>Description :</strong> {{ $objectif->description }}</p>
    <p><strong>Début :</strong> {{ $objectif->date_debut }}</p>
    <p><strong>Fin :</strong> {{ $objectif->date_fin }}</p>
    <p><strong>Attribué à :</strong> {{ $objectif->agent->name ?? 'Agent inconnu' }}</p>
</body>
</html>
