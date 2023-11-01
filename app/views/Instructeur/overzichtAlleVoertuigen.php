<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>document</title>
    <link rel="stylesheet" href="<?= URLROOT; ?>/css/style.css">
</head>

<body>

    <h3><u><?= $data['title']; ?></u></h3>



    <table>
        <thead>
            <th>TypeVoertuig</th>
            <th>Type</th>
            <th>Kenteken</th>
            <th>Bouwjaar</th>
            <th>Brandstof</th>
            <th>RijbewijsCategorie</th>
            <th>Instructeur</th>
            <th>Wijzigen</th>
            <th>Verwijderen</th>
        </thead>
        <tbody>
            <?= $data['tableRows']; ?>
        </tbody>
    </table>





</body>

</html>