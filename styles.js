$(document).ready(function (){

    //модальное окно
    let itemName; // Определение какой товар выбран пользователем
    let count;
    let productID;
    let modal = document.getElementById('myModal');
    let span = document.getElementsByClassName("close")[0];
    //модальное окно

    // Отслеживание нажатия на кнопку для открытие модального окна с оформлением заказа
    $(`.myBtn`).each(function (){
       $(this).on("click",function (){
           itemName = $(this).parent().data("name");
           count = $(this).parent().data("count");
           productID = $(this).parent().data("id");
           $(`.product`).css("border", "none");
           $(`.error`).hide();
           $(`.insert-item`).html(`<h4 class="mt-2 "> `+ itemName +  `</h4>`);
           modal.style.display = "block";

           //----------------------------------------------------------------------- Ajax отправка данных о пользователе и товара на сервер и валидация
           $('.buy-product').on("click", function (e){

               $(`.product`).css("border", "none");
               $(`.error`).hide();
               $(`.name`).attr('placeholder', '').css({
                   'border' : 'none',
               });
               $(`.mnumber`).attr('placeholder', '').css({
                   'border' : 'none',
               });
               $(`.error-name`).hide();
               $(`.error-mnumber`).hide();
               e.preventDefault();

               let userName = $.trim($('.name').val());
               let mnumber = $.trim($('.mnumber').val());
               const regNumber = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
               const regName = /^[a-zA-Zа-яА-Я'][a-zA-Zа-яА-Я-' ]+[a-zA-Zа-яА-Я']?$/u;
                // ---------------------------------------------------------------------------validation
               if(!userName){
                    $(`.name`).attr('placeholder', 'Введите Имя !').css({
                        'border' : '2px solid red',
                    });
                    $(`.error-name`).show().text('Заполните это поле!');
               }else if(!regName.test(userName)){
                   $(`.name`).attr('placeholder', 'Введите правильное имя !').css({
                       'border' : '2px solid red',
                   });
                   $(`.error-name`).show().text('Введите верные данные!');
               }else if(!mnumber){
                   $(`.mnumber`).attr('placeholder', 'Введите Номер !').css({
                       'border' : '2px solid red',
                   });
                   $(`.error-mnumber`).show().text('Заполните это поле!');
               }else if(!regNumber.test(mnumber)){
                   $(`.mnumber`).attr('placeholder', 'Неккоректный номер телефона !').css({
                       'border' : '2px solid red',
                   });
                   $(`.error-mnumber`).show().text('Введите верные данные!');
               } else{
                   $.ajax({
                       type: 'POST',
                       url: 'database.php',
                       data: {userName: userName, mnumber: mnumber, userItem: itemName, count: count, productID: productID },
                       error: function(req, text, error) {
                           console.log('Ошибка AJAX: ' + text + ' | ' + error);
                       },
                       success: function (data) {
                           if (data.status === true && data.code === 200){
                               $(`.error`).css("display", "block").css("border", "2px solid green").css("background-color", "#89fac4").html(`<p class="h4" style="display: flex; justify-content: center;">Товар успешно оформлен, ожидайте звонка!</p>`).delay(5000).hide(300);
                           }else if (data.status === false && data.code === 404){
                               $(`.error`).css("display", "block").css("background-color", "#cf7e7e").html(`<p class="h4" style="display: flex; justify-content: center">Что-то пошло не так,попробуйте позже</p>`).delay(5000).hide(300);
                               $(`.product`).css("border", "2px solid red");
                           }
                       },
                       dataType: 'json'
                   });
               }
           });
           //----------------------------------------------------------- Ajax
       });
    });
    //  ------------------------------------------- Закрытие модального окна
    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});