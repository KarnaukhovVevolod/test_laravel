<!--extends('delete.layout')-->

<!DOCTYPE html>
<html>
<head>
    <title>Страница просмотра пользователей и объектов пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

<h1>This is a Heading</h1>
<p>This is a paragraph.</p>
<!--yield('content')-->
@section('content')


    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    посмотреть  объекты пользователей
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">id</th>
                            <th scope="col">clientId</th>
                            <th scope="col">Data client</th>
                            <th scope="col">created</th>
                            <th scope="col">updated</th>
                            <th scope="col">удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;?>
                        @foreach($usersObject as $userObject)
                                <?php $i++; ?>
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$userObject->id}}</td>
                                <td>{{$userObject->client_id}}</td>
                                <td>{{$userObject->data_user}}</td>
                                <td>{{$userObject->created_at}}</td>
                                <td>{{$userObject->updated_at}}</td>
                                <td>

                                    <form class="delete-object" action="{{url("/delete/$userObject->id")}}" method="post"> @csrf
                                        <button class="btn btn-danger">удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Посмотреть полльзователей
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">login</th>
                            <th scope="col">password</th>
                            <th scope="col">created</th>
                            <th scope="col">updated</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;?>
                        @foreach($usersData as $userData)
                                <?php $i++; ?>
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$userData->id}}</td>
                                <td>{{$userData->name}}</td>
                                <td>{{$userData->email}}</td>
                                <td>{{$userData->login}}</td>
                                <td>{{$userData->password}}</td>
                                <td>{{$userData->created_at}}</td>
                                <td>{{$userData->updated_at}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table></div>
            </div>
        </div>

    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('../resources/js/delete.js') }}"></script>
</body>
</html>



<!--endsection-->
