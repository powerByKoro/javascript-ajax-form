<?php
define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('DATABASE', 'shop');

try {
    $pdo   = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'Что-то пошло не так с подключением к базе данных' . $e->getMessage();;
}


$query = $pdo->prepare("SELECT * FROM items");
$query->execute();
$items = $query->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['userName'], $_POST['mnumber'], $_POST['userItem'],$_POST['count'],$_POST['productID'])){
    $id = (int)$_POST['productID'];
    $count = (int)$_POST['count'];
    $count = $count - 1;

    try {
        $query = $pdo->prepare("UPDATE items SET count = :count WHERE id = :id;");
        $query->execute([
            'count' => $count,
            'id' => $id
        ]);

        $response = [
            'status' => true,
            'code' => 200
        ];
        echo json_encode($response);
    }catch (PDOException $e){
        $response = [
            'status' => false,
            'code' => 404
        ];
        echo json_encode($response);
    }
return;
}
