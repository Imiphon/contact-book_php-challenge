<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>contact-book php</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fonts.css">
</head>

<body>
    <div class="header">
        <img id="logo" src="images/Locri-toTheRight.png" alt="logo">
        <h2>Mein Kontaktbuch</h2>
        <?php
        if (isset($_GET['page'])) {
            if ($_GET['page'] == 'start') {
                $image = 'home.png';
            } elseif ($_GET['page'] == 'contacts') {
                $image = 'contacts.png';
            } elseif ($_GET['page'] == 'add') {
                $image = 'add.png';
            } elseif ($_GET['page'] == 'about') {
                $image = 'about.png';
            } elseif ($_GET['page'] == 'imprint') {
                $image = 'imprint.png';
            } else {
                $image = 'home.png';
            }
        } else {
            $image = 'home.png';
        }
        echo '<img class="theme-img" src="images/' . $image . '" alt="' . $headline . '">';
        ?>
    </div>

    <div class="main-frame">
        <div class="link-frame">
            <a href="index.php?page=start">Start</a>
            <a href="index.php?page=contacts">Kontakte</a>
            <a href="index.php?page=add">Neuer Kontakt</a>
            <a href="index.php?page=about">Über mich</a>
            <a href="index.php?page=imprint">Impressum</a>
        </div>
        <div class="content">
            <?php
            // Überprüfen, ob 'page' in der URL gesetzt ist
            if (isset($_GET['page'])) {
                if ($_GET['page'] == 'start') {
                    $headline = 'Herzlich Willkommen!';
                } elseif ($_GET['page'] == 'contacts') {
                    $headline = 'Deine Kontakte';
                } elseif ($_GET['page'] == 'add') {
                    $headline = 'Kontakt hinzufügen';
                } elseif ($_GET['page'] == 'about') {
                    $headline = 'Über mich';
                } elseif ($_GET['page'] == 'imprint') {
                    $headline = 'Impressum';
                } else {
                    $headline = 'Herzlich Willkommen!';
                }
            } else {
                $headline = 'Herzlich Willkommen!';
            }
            echo '<h1>' . $headline . '</h1>';
            ?>

            <?php
            include 'theme-content.php';

            echo '<div class="description"><p>' . $themeDescript . '</p></div>';
            if (!empty($themeContent)) {
                echo '<div class="contacts"><p>' . $themeContent . '</p></div>';
            }
            ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Lars Mensching</p>
    </div>

    <script>
        // Ausgabe der IDs in der Console
        const contacts = <?php echo json_encode($_SESSION['contacts']); ?>;
        contacts.forEach(contact => {
            console.log(`Kontakt ID: ${contact.id}`);
        });
    </script>
</body>

</html>