<?php
//startet 'superglobale var $_SESSION
session_start();
//assoziatives Array, das verwendet wird, um Daten über verschiedene Seitenaufrufe hinweg zu speichern.
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

//setzt neuen contact in das array
if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["tel"])) {
    $new_contact = [
        "id" => uniqid(),
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "tel" => $_POST["tel"]
    ];
    $_SESSION['contacts'][] = $new_contact;
    file_put_contents('my-contacts.txt', json_encode($_SESSION['contacts'], JSON_PRETTY_PRINT));
}

if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    foreach ($_SESSION['contacts'] as $index => $contact) {
        if ($contact['id'] === $idToDelete) {
            unset($_SESSION['contacts'][$index]);
            $_SESSION['contacts'] = array_values($_SESSION['contacts']); // Reindex array
            break;
        }
    }
}

$themeContent = '';

if (isset($_GET['page'])) {
    if ($_GET['page'] == 'start') {
        $themeDescript = 'Dies ist eine kleine contact app, erstellt mit php.';
    } elseif ($_GET['page'] == 'contacts') {
        $themeDescript = 'Hier sind deine Kontakte:<br>';

        foreach ($_SESSION['contacts'] as $contact) { //
            $themeContent .= '<div class="contact-container">';
            $themeContent .= '<p>Name: ' . htmlspecialchars($contact['name']) . '</p>';
            $themeContent .= '<p>Email: ' . htmlspecialchars($contact['email']) . '</p>';
            $themeContent .= '<p>Telefon: ' . htmlspecialchars($contact['tel']) . '</p>';
            $themeContent .= '<form action="index.php" method="GET">';
            $themeContent .= '<input type="hidden" name="page" value="contacts">';
            $themeContent .= '<input type="hidden" name="delete" value="' . htmlspecialchars($contact['id']) . '">';
            $themeContent .= '<button class="contact-button" type="submit">Löschen</button>';
            $themeContent .= '</form>';
            $themeContent .= '</div>';
        }
    } elseif ($_GET['page'] == 'add') {
        $themeDescript = 'Füge hier einen neuen Kontakt hinzu:';
        $themeContent = ' 
            <form class="form-frame" action="?page=contacts" method="POST">
                <div class="input-frame">
                    <input type="text"  name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="tel"   name="tel" placeholder="Telefon" required>
                </div>            
                <button class="input-button" type="submit">Speichern</button>                    
            </form>';
    } elseif ($_GET['page'] == 'about') {
        $themeDescript = 'Ich bin Junior Frontend Developer und habe diese app gebaut, um ein wenig php kennenzulernen.';
    } elseif ($_GET['page'] == 'imprint') {
        $themeDescript = 'Diese app sammelt keine Daten.';
    }
} else {
    $themeDescript = 'Willkommen auf meiner kleinen contact app, erstellt mit php.';
}
// ein closing tag (zusammengeschriebenes:  ? und >  ) wird am Ende vermieden, um Leerzeichen zu vermeiden.

