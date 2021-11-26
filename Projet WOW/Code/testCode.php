<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // include et config BD
    include_once "./config/db.php";
    try {
        $bdd = new PDO(DBDRIVER . ':host=' . DBHOST . ';port=' . DBPORT .
            ';dbname=' . DBNAME . ';charset='
            . DBCHARSET, DBUSER, DBAPSS);
    } catch (Exception $e) {
        // en mode dev, on veut connaitre toutes les infos
        echo $e->getMessage();
        die();
    }

    // include autoload (classes)
    include "./vendor/autoload.php";
 

    
    // Dans ce script:
    // 1. Créer un Type de Character et le stocker dans la BD
    // 2. Créer un Player et le stocker dans la BD
    // 3. Créer trois Character et le stocker dans la BD, les rajouter au Player
    // 4. Créer un Combat entre deux Character

    // créons un Type, puis on commente les lignes pour ne pas créer de doublons dans la BD
    $typeManager = new TypeManager ($bdd);

    $type1 = new Type ([
        'name'=> 'witch',
        'minLP'=>18,
        'maxLP'=>20,
        'minAP'=>10,
        'maxAP'=>15,
    ]);

    $type2 = new Type ([
        'name'=> 'elf',
        'minLP'=>17,
        'maxLP'=>20,
        'minAP'=>8,
        'maxAP'=>15,
    ]);
    $typeManager->insert ($type1);
    $typeManager->insert ($type2);

    

    $p1Manager = new PlayerManager($bdd);
    $p1 = new Player([
        'name' => 'player1',
        'email' => 'p1@fastmail.com'
    ]);
    $p1Manager->insert($p1);
    
    
    $chManager = new CharacterManager($bdd);
    $c1 = new Character([
        'name' => 'Witch Stefania',
        'type' => $type1 // ici on injecte le type
        // LP et AP sont générés dans le constructeur en utilisant le random du Type!
    ]);
    $c2 = new Character([
        'name' => 'Witch Laure',
        'type' => $type1 
        // LP et AP sont générés dans le constructeur en utilisant le random du Type!
    ]);
    $c3 = new Character([
        'name' => 'Elf Ylenia',
        'type' => $type2 // ici on injecte le type
        // LP et AP sont générés dans le constructeur en utilisant le random du Type!
    ]);

    $chManager->insert ($c1);
    $chManager->insert ($c2);
    $chManager->insert ($c3);

    // rajouter les Characters au Player
    $p1->addCharacter($c1);
    $p1->addCharacter($c2);
    $p1->addCharacter($c3);

    // créer un Combat
    $combat1 = new Combat(new DateTime()); // new DateTime ("2001-4-20");
    $combat1->addParticipant ($p1);
    $combat1->addParticipant ($p2);
    $combat1->launch(); // lancera à l'intérieur un setWinner();
    

    // lancer le combat. 
    $combat1->launch(); // on peut identifier toujours le Character winner car on a l'id du Character




    
    var_dump($p1);


    ?>
</body>

</html>