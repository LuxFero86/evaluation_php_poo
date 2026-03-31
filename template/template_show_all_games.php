<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= $title ?? "" ?></title>
</head>

<body>
    <?php include 'component/navbar.php'; ?>
    <main class="container-fluid">
        <section>
            <h2>Liste des Jeux</h2>
            <?php foreach ($data["games"] as $game) : ?>
                <article>
                    <h3><?= $game->getTitle() ?></h3>
                    <p><?= 'Type : '.$game->getType() ?></p>
                    <p><?= 'Publié le : '.$game->getPublishAt() ?></p>
                    <p><?= 'Console : '.$game->getConsole()->getName() ?></p>
                </article>
            <?php endforeach ?>
        </section>
    </main>
</body>

</html>