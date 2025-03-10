<?php
$db = mysqli_connect('localhost', 'root', '', 'podroze');

// INFO: można to też zrobić w środku HTMLa, ale dla autora
// tak wygląda to lepiej (podział na logikę i wygląd).

// skrypt 1
$q = "SELECT nazwaPliku, podpis FROM zdjecia ORDER BY podpis";
$r = mysqli_query($db, $q);
$obrazy = mysqli_fetch_all($r, MYSQLI_BOTH);

// skrypt 2
$q = "SELECT cel, dataWyjazdu FROM wycieczki WHERE dostepna = 0";
$r = mysqli_query($db, $q);
$wycieczki = mysqli_fetch_all($r, MYSQLI_BOTH);

mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poznaj Europę</title>
    <link rel="stylesheet" href="styl9.css">
</head>
<body>
    <header>
        <h1>BIURO PODRÓŻY</h1>
    </header>
    <div class="site">
        <aside class="left">
            <h2>Promocje</h2>
            <table>
                <tr>
                    <td>Warszawa</td>
                    <td>od 600 zł</td>
                </tr>
                <tr>
                    <td>Wenecja</td>
                    <td>od 1200 zł</td>
                </tr>
                <tr>
                    <td>Paryż</td>
                    <td>od 1200 zł</td>
                </tr>
            </table>
        </aside>
        <main>
            <h2>W tym roku jedziemy do...</h2>
            <?php foreach($obrazy as $obraz): ?>
                <img src="<?= $obraz['nazwaPliku'] ?>" alt="<?= $obraz['podpis'] ?>" title="<?= $obraz['podpis'] ?>" />
            <?php endforeach; ?>
        </main>
        <aside class="right">
            <h2>Kontakt</h2>
            <a href="mailto:biuro@wycieczki.pl">napisz do nas</a>
            <p>telefon: 444555666</p>
        </aside>
    </div>
    <section class="data">
        <h3>W poprzednich latach byliśmy...</h3>
        <ol>
            <?php foreach($wycieczki as $wycieczka): ?>
                <li>Dnia <?= $wycieczka['dataWyjazdu'] ?> pojechaliśmy do <?= $wycieczka['cel'] ?></li>
            <?php endforeach ?>
        </ol>
    </section>
    <footer>
        <p>Stronę wykonał: 123456789112</p>
    </footer>
</body>
</html>