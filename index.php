<?php
session_start();
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
require_once 'database.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Интернет магазин</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script src="styles.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
</head>
<body>


<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2 style="padding-right: 45%">Оформление заказа</h2>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-4 mt-5">
                        <form class="form-action">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ваше полное имя</label>
                                <input type="text" class="form-control name" id="exampleInputEmail1" name="name" required pattern="[А-Яа-я]*?\s[А-Яа-я]*?\s[А-Яа-я]">
                                <p class="error-name" style="display: none; color: red"></p>
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleInputPassword1">Номер вашего телефона</label>
                                <input type="tel" class="form-control mnumber" id="exampleInputPassword1" name="mnumber" required>
                                <p class="error-mnumber" style="display: none; color: red"></p>
                            </div>
                            <div class="form-group insert-item" style="display: flex; justify-content: center">

                            </div>
                            <div style="display: flex; justify-content: center">
                                <div class="">
                                    <button type="submit" class="btn btn-primary mt-3 buy-product" >Оформить заказ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="error col-5 offset-3 mt-3" ></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <?php foreach ($items as $item){?>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body" data-name="<?php echo $item['name'] ?>" data-id="<?php echo $item['id'] ?>" data-count="<?php echo $item['count']?>">
                            <h5 class="card-title"><?php echo $item['name']?></h5>
                            <p class="card-text"><?php echo $item['description']?></p>
                            <p class="card-text"><?php echo $item['price']?> руб.</p>
                            <button class="myBtn">Открыть окно</button>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
