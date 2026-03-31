<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= $title ?></title>
</head>

<body>
    <?php include 'component/navbar.php'; ?>
    <main>
        <h2>Ajouter un Jeu</h2>
        <form action="" method="post">
            <input type="text" name="title" placeholder="Saisir le titre" required>
            <input type="text" name="type" placeholder="Saisir le type" required>
            <label for="publishAt">Saisir la date de publication</label>
            <input type="date" name="publishAt">
            <select name="console">
                <option selected disabled value="">
                    Sélectionner une console
                </option>
            <?php foreach ($data["consoles"] as $console): ?>
                <option value="<?= $console->getId() ?>">
                    <?= $console->getName() ?>
                </option>
            <?php endforeach ?>
            </select>
            <input type="submit" name="submit" value="Ajouter">
        </form>
        <?php if(!empty($data["msg"])): ?>
        <p><?= $data["msg"] ?></p>
        <?php endif ?>
    </main>
</body>

</html>