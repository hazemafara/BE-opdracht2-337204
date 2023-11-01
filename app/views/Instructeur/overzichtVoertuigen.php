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
        <tbody>
            <tr>
                <th>Naam:</th>
                <td><?= $data['naam']; ?></td>
            </tr>
            <tr>
                <th>Datum in Dienst:</th>
                <td><?= $data['datumInDienst']; ?></td>
            </tr>
            <tr>
                <th>Aantal Sterren</th>
                <td><?= $data['aantalSterren']; ?></td>
            </tr>
        </tbody>
    </table>

    <a href="/instructeur/overzichtBeschikbareVoertuigen/<?= $data['id'] ?>">Toevoegen Voertuig</a>



    <table>
        <thead>
            <th>TypeVoertuig</th>
            <th>Type</th>
            <th>Kenteken</th>
            <th>Bouwjaar</th>
            <th>Brandstof</th>
            <th>RijbewijsCategorie</th>
            <th>Wijzigen</th>
            <th>Verwijderen</th>
        </thead>
        <tbody>
            <?= $data['tableRows']; ?>
        </tbody>
    </table>





</body>

</html>