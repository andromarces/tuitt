<?php
function display_title()
{
    echo "Items";
}

function display_style()
{}

function display_content()
{?>

    <form class="col-12 col-md-8 col-lg-9 border rounded border-dark" action="register_endpoint.php" method="POST">
        <div class="form-group">
            <label for="exampleInputFullName1">Full Name</label>
            <input type="text" class="form-control" id="exampleInputFullName1" aria-describedby="fullNameHelp" placeholder="Enter Full Name"
                name="name" required>
            <small id="fullNameHelp" class="form-text text-muted">We'll never share your info with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputUsername2">Username</label>
            <input type="text" class="form-control" id="exampleInputUsername2" aria-describedby="usernameHelp" placeholder="Enter Username"
                name="username" required>
        </div>
        <div class="form-group">
            <strong id="userCheck"></strong>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword3">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Confirm Password" name="password2">
        </div>
        <div class="form-group">
            <strong id="passCheck"></strong>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck2">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary" id="btn" name="submit" disabled>Register</button>
    </form>

    <?php }?>

    <?php
function display_script()
{?>


        <script>
            $('input[type=password]').on('input', function () {
                if ($('#exampleInputPassword2').val() !=
                    $('#exampleInputPassword3').val() || $('#exampleInputPassword2').val() == "") {
                    $('#passCheck').css('color', 'red');
                    $('#passCheck').html('Not matching.');
                    $('#btn').prop('disabled', 'true');
                    $('#btn').css('background', 'gray');
                } else {
                    $('#passCheck').css('color', 'green');
                    $('#passCheck').html('Matching.');
                    $('#btn').prop('disabled', 'false');
                    $('#btn').css('background', '#0069d9');
                }
            });

            var users;
            $.getJSON("users.json", function (json) {
                users = json;
            });

            $('#exampleInputUsername2').on('input', function () {
                var username = $('#exampleInputUsername2').val();
                if (typeof users[username] !== 'undefined') {
                    $('#userCheck').css('color', 'red');
                    $('#userCheck').html('Username exists.');
                } else {
                    $('#userCheck').css('color', 'green');
                    $('#userCheck').html('Username available.');
                }
            });
        </script>


        <?php }

require "template.php";

?>