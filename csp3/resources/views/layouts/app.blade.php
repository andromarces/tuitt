<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config("app.name", "EventBook") }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset("css/style.css") }}" rel="stylesheet">
</head>

<body>
    <div id="app">
    @include("partials.navbar")
        

        <main class="py-4">
            @yield("content")
        </main>
    </div>

    @include("partials.modals")

    {{-- hidden div1 --}}
    <div id="hiddenDiv1" class="d-none"></div>

    {{-- hidden div2 --}}
    <div id="hiddenDiv2" class="d-none"></div>

    {{-- hidden div3 --}}
    <div id="hiddenDiv3" class="d-none"></div>

    {{-- hidden div4 --}}
    <div id="hiddenDiv4" class="d-none"></div>

    {{-- csrf token --}}
    <div id="csrf">
        <div id="token" data-token="{{ csrf_token() }}"></div>
    </div>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset("js/script.js") }}"></script>
</body>

</html>