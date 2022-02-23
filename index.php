<?php

require_once 'vendor/autoload.php';
use App\Person;
use Doctrine\DBAL\DriverManager;

$parameters = [
    'dbname' => 'Register',
    'user' => '',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql'
];
try {
    $connection = DriverManager::getConnection($parameters);
} catch (\Doctrine\DBAL\Exception $e) {
    print "Error!" . $e->getMessage() . "<br/>";
    die();
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $idNumber = $_POST['idNumber'];
    $email = $_POST['email'];
    $person = new Person($name, $surname, $idNumber, $email);

    try {
        $connection->insert('persons',
                ['name' => $person->getName(),
                'surname' => $person->getSurname(),
                'person_id' => $person->getIdNumber(),
                'email' => $person->getEmail()]);
    } catch (\Doctrine\DBAL\Exception $e) {
        print "Error!" . $e->getMessage() . "<br/>";
        die();
    }
}


try {
    $registry = $connection->fetchAllAssociative('SELECT * FROM persons');
} catch (\Doctrine\DBAL\Exception $e) {
    print "Error!" . $e->getMessage() . "<br/>";
    die();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Person registry</title>
</head>

<header>
    <h1>
        Person registry tool
    </h1>
</header>
<body>

<form action="/" method= "post">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="surname" placeholder="Surname">
    <input type="text" name="idNumber" placeholder="ID Number">
    <input type="text" name="email" placeholder="E-mail">
    <button class="button" type="submit" name="submit"> SUBMIT </button>
</form>

<br>
<div>
    <h3>Registered persons </h3>
</div>
<br>
<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Person ID</th>
            <th>E-mail</th>
        </tr>

        <?php foreach($registry as $person): ?>
    <tr>
        <td> <?php echo $person['id'] ?></td>
        <td> <?php echo $person['name'] ?></td>
        <td> <?php echo $person['surname'] ?></td>
        <td> <?php echo $person['person_id'] ?></td>
        <td> <?php echo $person['email'] ?></td>
    </tr>
        <?php endforeach;?>
    </table>
</div>

</body>
</html>
