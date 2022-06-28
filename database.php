<?php


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

        //-----------------------------------------
        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';

        $name = $_POST['userName'];
        $phone = $_POST['mnumber'];
        $item = $_POST['userItem'];

        $mail->isSMTP();
       
        $mail->Port = 465;

       

        $mail->isHTML(true);

        $mail->Subject = 'Заявка с тестового сайта';
        $mail->Body    = 'Клиент ' .$name . ' заказал товар '. $item. ' номер его телефона : ' .$phone;
        $mail->AltBody = '';

        if(!$mail->send()) {
            $response = [
                'status' => false,
                'code' => 404
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => true,
                'code' => 200
            ];
            echo json_encode($response);
        }
        //----------------------------------------------------
    }catch (PDOException $e){
        $response = [
            'status' => false,
            'code' => 404
        ];
        echo json_encode($response);
    }
return;
}
?>

