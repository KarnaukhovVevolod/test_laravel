document.querySelector('.create-object').addEventListener('click', function () {
    event.preventDefault();
    let token = document.querySelector('.token_create').value;
    let url = document.querySelector('.url_create').value;
    let body = document.querySelector('.body_create').value;
    let method = document.querySelector('.select_create').value;
    let server_response = document.querySelector('.server_create');
    let json = JSON.stringify({data: body});
    //alert(json);
    if (method == 0) {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: json
        })
            .then((response) => response.json())
            .then((data) => {
                alert('Ответ от сервера');
                console.log(data);
                server_response.value = JSON.stringify(data);

            });
    } else {
        fetch(url+'?data='+body, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            //body: json
        })
            .then((response) => response.json())
            .then((data) => {
                alert('Ответ от сервера');
                console.log(data);
                server_response.value = JSON.stringify(data);

            });
    }
});
