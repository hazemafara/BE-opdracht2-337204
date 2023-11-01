<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= URLROOT; ?>/css/style.css">
    <title>Voertuig Wijzigen</title>
</head>

<body>
    <u><?= $data['title']; ?></u>

    <form method="post">
        <label for="instructeur">Instructeur:</label>
        <select name="instructeur" id="instructeur">
            <?php foreach ($data['instructeurs'] as $instructeur) : ?>
                <option value="<?= $instructeur->Id ?>"><?= $instructeur->Voornaam, " ", $instructeur->Tussenvoegsel, " ", $instructeur->Achternaam ?></option>
            <?php endforeach ?>
        </select>
        <br>

        <label for="type_voertuig">Type Voertuig:</label>
        <select name="type_voertuig" id="type_voertuig">
            <?php foreach ($data['typeVoertuig'] as $typeVoertuig) : ?>
                <option value="<?= $typeVoertuig->Id ?>" <?= $typeVoertuig->Id === $data['voertuig']->TypeVoertuigId ? 'selected' : '' ?>>
                    <?= $typeVoertuig->TypeVoertuig ?>
                </option>
            <?php endforeach ?>
        </select>
        <br>

        <label for="type">Type:</label>
        <input type="text" name="type" id="type" value="<?= $data['voertuig']->Type ?>">
        <br>

        <label for="bouwjaar">Bouwjaar:</label>
        <input type="date" id="bouwaar" name="bouwjaar" readonly value="<?= $data['voertuig']->Bouwjaar ?>">
        <br>

        <label>Brandstof:</label>
        <input type="radio" name="brandstof" id="diesel" value="Diesel" <?= $data['voertuig']->Brandstof === 'Diesel' ? 'checked' : '' ?>>
        <label for="diesel">Diesel</label>
        <input type="radio" name="brandstof" id="benzine" value="Benzine" <?= $data['voertuig']->Brandstof === 'Benzine' ?  'checked' : '' ?>>
        <label for="benzine">Benzine</label>
        <input type="radio" name="brandstof" id="elektrisch" value="Elektrisch" <?= $data['voertuig']->Brandstof === 'Elektrisch' ? 'checked' : '' ?>>
        <label for="electrisch">Elektrisch</label>
        <br>

        <label for="kenteken">Kenteken:</label>
        <input type="text" name="kenteken" id="kenteken" value="<?= $data['voertuig']->Kenteken ?>">
        <br>

        <button>Wijzig</button>
    </form>

</body>

</html>