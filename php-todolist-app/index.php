<?php $todos = file_get_contents('assets/todos.json');
$todos = json_decode($todos, true);?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PHP To-Do List</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
        crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script> -->
    <link rel="stylesheet" href="assets/lib/bootstrap.css">
    <script defer src="assets/lib/fontawesome-5.0.4.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="card text-center col-12 col-md-10 col-lg-8 col-xl-6 mt-3 mt-lg-5 mx-auto px-0">
        <div class="card-header">
            <h1>
                <strong>TO-DO LIST</strong>
            </h1>
        </div>
        <div class="card-body">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="newTask" aria-label="Add New Task" placeholder="Add New Task">
                <div class="input-group-append">
                    <button type="button" class="btn btn-success">
                        <i class="fas fa-plus-square"></i>
                    </button>
                </div>
            </div>
            <ul class="list-group text-left">
                <?php foreach ($todos as $key => $todo) {
                if ($todo['done'] === false) {?>
                <li class="list-group-item p-0" id="<?php echo $key; ?>">
                    <button type="button" class="btn btn-danger">
                        <i class="fas fa-trash-alt" data-fa-transform="down-1"></i>
                    </button>
                    <strong>
                        <?php echo $todo['task']; ?>
                    </strong>
                </li>
                <?php } else {?>
                <li class="list-group-item p-0" id="<?php echo $key; ?>" class="completed">
                    <button type="button" class="btn btn-danger fa-1x">
                        <i class="fas fa-trash-alt" data-fa-transform="down-1"></i>
                    </button>
                    <strong>
                        <?php echo $todo['task']; ?>
                    </strong>
                </li>
                <?php }}?>
            </ul>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
        crossorigin="anonymous"></script> -->
    <script src="assets/lib/jquery-3.2.1.min.js"></script>
    <script src="assets/lib/popper.min.js"></script>
    <script src="assets/lib/bootstrap.js"></script>
    <script src="assets/js/todo.js"></script>
</body>

</html>