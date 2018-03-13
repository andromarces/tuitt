<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>AJAX and JSON Example</title>

</head>

<body>

    <h2>Type pikachu, charmander, or squirtle</h2>
    Input:
    <input type="text" id="myinput">
    <button id="mybutton">Submit</button>

    <div id="jsonsection"></div>
    <div id="outputsection"></div>

    <hr>

    <button id="viewUsers">View Users</button>

    <ul id="userList"></ul>

    <hr>

    <input type="text" id="userName" placeholder="Username">
    <input type="password" id="passWord" placeholder="Password">
    <button id="validateUser">Validate User</button>

    <hr>

    <input type="text" name="nameInput" id="nameInput">
    <p id="namesSuggested"></p>

    <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#mybutton').click(function () {
                var myInput = $('#myinput').val();
                // console.log(myInput);
                $.ajax({
                    'url': 'assets/lib/server.php',
                    'data': {
                        'pokemon': myInput
                    },
                    'type': 'GET',
                    'success': editHTML
                });
            });
        });

        function editHTML(jsonData) {

            // console.log(jsonData);

            $('#jsonsection').html("Received:" + jsonData);

            if (jsonData != 0) {
                data = JSON.parse(jsonData);
                // console.log(data);

                htmlstr = "<hr>";
                htmlstr += "Name:" + data.name + "<br>";
                htmlstr += "Type:" + data.type + "<br>";
                htmlstr += "Basic Move:" + data.moves.basic + "<br>";
                htmlstr += "Advanced Move:" + data.moves.special + "<br>";

                $('#outputsection').html(htmlstr);

            } else {

                $('#outputsection').html("<hr> Pokemon info not found.");
                // console.log("1");
            }
        }

        $('#viewUsers').click(function () {
            $.get('assets/lib/get.php', function (data, status) {
                var user = JSON.parse(data);
                // console.log(user[0].name);
                // console.log(status);
                for (var i = 0; i < user.length; i++) {
                    // console.log(user[i].name);
                    // console.log(user[i].email);
                    // console.log(user[i].password);
                    var name = user[i].name;
                    var email = user[i].email;
                    var password = user[i].password;

                    newEntry = '<strong>Name:</strong> ' + name + '<br><strong>Email:</strong> ' +
                        email + '<br><strong>Password:</strong> ' + password;

                    $('#userList').append('<li>' + newEntry + '</li><br>');
                }
            });
        });

        $('#validateUser').click(function () {
            var name = $('#userName').val();
            // consol.log(name);

            $.post('assets/lib/post.php', {
                    'name': name
                },
                function (data) {
                    console.log('Processed data: ' + data);
                });
        });

        $(document).ready(function () {
            $('input').keyup(function () {
                var name = $('#nameInput').val();
                // console.log(name);

                $.post('assets/lib/name_suggestions.php', {
                        'suggestion': name
                    },
                    function (data, status) {
                        // console.log(data);
                        $('#namesSuggested').html(data);

                    });
            });
        });
    </script>
</body>

</html>