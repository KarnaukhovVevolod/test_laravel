<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<h1>Страница для тестирования api</h1>
<!-- форма для тестирования api  -->
<div class="form-control ">
    <form>
        <label>Форма для добавления объекта</label>
        <div class="mb-3">
            <label for="exampleFormControlInput0" class="form-label">Токен</label>
            <input type="text" class="form-control token_create" id="exampleFormControlInput0" placeholder="Введите токен">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Адрес</label>
            <input type="text" class="form-control url_create " id="exampleFormControlInput1" placeholder="Введите адрес url Например:http://localhost/test/public/create">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Введите тело запроса для добавления объекта в формате json</label>
            <textarea class="form-control body_create" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">ответ от сервера</label>
            <textarea class="form-control server_create" id="exampleFormControlTextarea2" rows="3"></textarea>
        </div>
        <select class="form-select select_create" aria-label="Default select example">
            <option value="0" selected> POST - метод для отправки запроса</option>
            <option value="1">GET - метод для отправки запроса</option>
        </select>
        <button  class="btn btn-primary create-object">Submit</button>
    </form>
</div>
<!-- конец формы для тестирования api -->
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('../resources/js/delete.js') }}"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>

