<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tasks</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap4.0.0.min.css') }}"> {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <script defer src="{{ asset('js/fontawesome5.0.6.js') }}"></script>
    <style>
        .taskinput,
        .commentinput {
            display: none;
        }

        .deleteAlert,
        .editAlert {
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            display: none;
            top: 100px;
        }
    </style>
</head>

<body>

    @yield("navbar")

    <div class="card col-12 col-md-6 mx-auto mt-5 px-0">
        <div class="card-header">
            Tasks
        </div>
        <div class="card-body">
            <h5 class="card-title">Create a New Task</h5>
            <div class="form-group">
                <form id="addTaskFrm">
                    <input pattern="( *?\S){5,}" title="Minimum of 5 characters not including spaces." class="form-control" type="text" name="task"
                        required>
                    <br>
                    <button class="btn btn-success addTskBtn" type="submit" name="submit">
                        <i class="fas fa-plus"></i> Add Task</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card col-12 col-md-6 mx-auto my-5 px-0">
        <div class="card-header">
            Current Tasks
        </div>
        <div class="card-body currentTasks">
            <table class="table">
                @if (count($tasks) > 0)
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Task Number</th>
                        <th scope="col">User</th>
                        <th scope="col">Time</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr class="task{{$task->id}}">
                        <td class="font-weight-bold oldTask" colspan="2">
                            Task {{$loop->iteration}}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="task{{$task->id}}">
                        <td colspan="2">
                            <div class="tasktxt">{{$task->name}}</div>
                            <input pattern="( *?\S){5,}" title="Minimum of 5 characters not including spaces." type="text" class="form-control taskinput"
                                value="{{$task->name}}">
                        </td>
                        <td>
                            {{$task->user->name}}
                        </td>
                        <td>
                            {{$task->updated_at->diffForHumans()}}
                        </td>
                        @if ($task->user_id == Auth::user()->id)
                        <td class="text-center">
                            <button class="btn btn-primary editBtn" data-index="{{$task->id}}">
                                <i class="fas fa-edit"></i> Edit</button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger delBtn" data-index="{{$task->id}}">
                                <i class="fas fa-trash-alt"></i> Delete</button>
                        </td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    <tr class="task{{$task->id}}">
                        <td></td>
                        <td class="font-weight-bold">
                            Comments
                        </td>
                        <td class="font-weight-bold">
                            User
                        </td>
                        <td class="font-weight-bold">
                            Time
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if (count($comments) > 0) @foreach($comments as $comment) @if ($comment->task_id == $task->id)
                    <tr id="comment{{$comment->id}}" class="task{{$task->id}}">
                        <td></td>
                        <td>
                            <div class="commenttxt">{{$comment->comments}}</div>
                            <input pattern="( *?\S){5,}" title="Minimum of 5 characters not including spaces." type="text" class="form-control commentinput"
                                value="{{$comment->comments}}">
                        </td>
                        <td>
                            {{$comment->user->name}}
                        </td>
                        <td>
                            {{$comment->updated_at->diffForHumans()}}
                        </td>
                        @if ($comment->user_id == Auth::user()->id)
                        <td class="text-center">
                            <button class="btn btn-primary editCmtBtn" data-index="{{$comment->id}}">
                                <i class="fas fa-edit"></i> Edit</button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger delCmtBtn" data-index="{{$comment->id}}">
                                <i class="fas fa-trash-alt"></i> Delete</button>
                        </td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    @endif @endforeach @endif
                    <tr class="task{{$task->id}}">
                        <td></td>
                        <td>
                            <input pattern="( *?\S){5,}" title="Minimum of 5 characters not including spaces." type="text" class="form-control addCmt"
                                required>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-success addCmtBtn" data-index="{{$task->id}}" disabled>
                                <i class="fas fa-plus"></i> Add</button>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="d-none">
                        <td colspan="6" id="totalTasks">{{$loop->count}}</td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <thead>
                    <tr>
                        <th>There are no tasks!</thead>
                </tr>
                </th>
                @endif
            </table>
        </div>
    </div>
    <div class="alert alert-danger editAlert col-5 position-fixed alert-dismissible" role="alert">
        <strong id="alertTxt"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper1.12.9.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap4.0.0.min.js') }}"></script>
    {{--
    <script src="{{ asset('js/app.js') }}"></script> --}}

    <script>
        "use strict"

        // get total number of tasks
        if ($("#totalTasks").html() == null) {
            var totalTasks = 0;
        } else {
            var totalTasks = parseInt($("#totalTasks").html());
        }

        // auto attach csrf tokens to all requests (from meta csrf tag in head)
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            }
        });

        // get logged-in username
        var username = "{{Auth::user()->name}}";

        // regex for min 5 chars not including spaces
        var regex = new RegExp("( *?\\S){5,}");

        // add new task
        $("#addTaskFrm").on("submit", function (e) {
            e.preventDefault();
            var taskInput = $(this).children("input").val();
            window.history.replaceState("", "Tasks", "/");
            $("#addTaskFrm").find("*").prop("disabled", true);
            $(".currentTasks").find("button").prop("disabled", true);
            $.ajax({
                method: "post",
                url: "/task",
                data: {
                    task: taskInput
                },
                success: function (data) {
                    totalTasks += 1;
                    if (totalTasks == 1) {
                        $(".currentTasks").children(".table").empty();
                        $(".currentTasks").children(".table").prepend($(
                            "<thead><tr><th scope='col' colspan='2'>Task Number</th><th scope='col'>User</th><th scope='col'>Time</th><th scope='col'></th><th scope='col'></th></tr></thead><tbody><tr><td class='font-weight-bold' colspan=2>Task " +
                            totalTasks +
                            "</td><td></td><td></td><td></td><td></td></tr><tr><td colspan=2><div>" +
                            taskInput + "</div></td><td>" + username +
                            "</td><td>1 second ago</td><td class='text-center'><button class='btn btn-primary'><i class='fas fa-edit'></i> Edit</button></td><td class='text-center'><button class='btn btn-danger'><i class='fas fa-trash-alt'></i> Delete</button></td></tr><tr><td></td><td class='font-weight-bold'>Comments</td><td class='font-weight-bold'>User</td><td class='font-weight-bold'>Time</td><td></td><td></td></tr><tr><td></td><td><input type='text' class='form-control'></td><td class='text-center'><button class='btn btn-success'><i class='fas fa-plus'></i> Add</button></td><td></td><td></td><td></td></tr></tbody>"
                        ).hide().animate({
                            margin: "show",
                            padding: "show",
                            opacity: "show",
                            height: "show"
                        }, function () {
                            $(".currentTasks").load(" .table");
                            $("#addTaskFrm").find("*").prop("disabled", false);
                            $("#addTaskFrm").find("input").val("");
                        }));
                    } else {
                        $(".currentTasks").children(".table").prepend($(
                            "<tr><td class='font-weight-bold' colspan=2>Task 1</td><td></td><td></td><td></td><td></td></tr><tr><td colspan=2><div>" +
                            taskInput + "</div></td><td>" + username +
                            "</td><td>1 second ago</td><td class='text-center'><button class='btn btn-primary'><i class='fas fa-edit'></i> Edit</button></td><td class='text-center'><button class='btn btn-danger'><i class='fas fa-trash-alt'></i> Delete</button></td></tr><tr><td></td><td class='font-weight-bold'>Comments</td><td class='font-weight-bold'>User</td><td class='font-weight-bold'>Time</td><td></td><td></td></tr><tr><td></td><td><input type='text' class='form-control'></td><td class='text-center'><button class='btn btn-success'><i class='fas fa-plus'></i> Add</button></td><td></td><td></td><td></td></tr>"
                        ).hide().animate({
                            margin: "show",
                            padding: "show",
                            opacity: "show",
                            height: "show"
                        }, function () {
                            var taskNo = 2;
                            $(".oldTask").each(function () {
                                $(this).html("Task " + taskNo++);
                            });
                            $(".currentTasks").load(" .table");
                            $("#addTaskFrm").find("*").prop("disabled", false);
                            $("#addTaskFrm").find("input").val("");
                        }));
                    }
                },
                error: function (data) {
                    $("#addTaskFrm").find("*").prop("disabled", false);
                    $(".currentTasks").find("button").prop("disabled", false);
                    $(".taskinput").each(function () {
                        if (regex.test($(this).val())) {
                            $(this).closest("tr").find(".editBtn").prop("disabled", false);
                        } else {
                            $(this).closest("tr").find(".editBtn").prop("disabled", true);
                        }
                    });
                    $(".commentinput").each(function () {
                        if (regex.test($(this).val())) {
                            $(this).closest("tr").find(".editCmtBtn").prop("disabled",
                                false);
                        } else {
                            $(this).closest("tr").find(".editCmtBtn").prop("disabled", true);
                        }
                    });
                    $(".addCmt").each(function () {
                        if (regex.test($(this).val())) {
                            $(this).closest("tr").find(".addCmtBtn").prop("disabled", false);
                        } else {
                            $(this).closest("tr").find(".addCmtBtn").prop("disabled", true);
                        }
                    });
                    console.log(data.responseText);
                    $("#alertTxt").html(
                        "An error has occurred! Please contact an admin or try again.");
                    $(".editAlert").fadeIn();
                    setTimeout(function () {
                        $(".editAlert").fadeOut();
                    }, 5000);
                }
            });
        });

        // edit task
        $(".currentTasks").on("click", ".editBtn", function () {
            var index = $(this).data("index");
            var element = $(this);
            var task = $(this).closest("tr").find(".taskinput").val();
            var orig = $(this).closest("tr").find(".tasktxt").html();
            if ($(this).html().indexOf("Save") == -1) {
                $(this).closest("tr").find(".tasktxt").fadeOut(function () {
                    $(this).closest("tr").find(".editBtn").html("<i class='fas fa-edit'></i> Save Edit");
                    $(this).closest("tr").find(".delBtn").html("<i class='fas fa-ban'></i> Cancel Edit");
                    $(this).closest("tr").find(".taskinput").fadeIn();
                });
            } else {
                $(".currentTasks").find("button").prop("disabled", true);
                $(".addTskBtn").prop("disabled", true);
                $.ajax({
                    method: "post",
                    url: "/task/" + index,
                    data: {
                        task: task,
                    },
                    success: function (data) {
                        $(element).closest("tr").find(".taskinput").fadeOut(function () {
                            $(element).closest("tr").find(".editBtn").html(
                                "<i class='fas fa-edit'></i> Edit");
                            $(element).closest("tr").find(".delBtn").html(
                                "<i class='fas fa-trash-alt'></i> Delete");
                            $(element).closest("tr").find(".tasktxt").html(task);
                            $(element).closest("tr").find(".tasktxt").fadeIn(function () {
                                $(".currentTasks").load(" .table");
                            });
                        });
                        $("#addTaskFrm").find("*").prop("disabled", false);
                    },
                    error: function (data) {
                        $(element).closest("tr").find(".taskinput").fadeOut(function () {
                            $(element).closest("tr").find(".editBtn").html(
                                "<i class='fas fa-edit'></i> Edit");
                            $(element).closest("tr").find(".delBtn").html(
                                "<i class='fas fa-trash-alt'></i> Delete");
                            $(element).closest("tr").find(".taskinput").val(orig);
                            $(element).closest("tr").find(".tasktxt").fadeIn();
                        });
                        $("#addTaskFrm").find("*").prop("disabled", false);
                        $(".taskinput").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".editBtn").prop("disabled", false);
                            } else {
                                $(this).closest("tr").find(".editBtn").prop("disabled", true);
                            }
                        });
                        $(".commentinput").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".editCmtBtn").prop("disabled",
                                    false);
                            } else {
                                $(this).closest("tr").find(".editCmtBtn").prop("disabled", true);
                            }
                        });
                        $(".addCmt").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".addCmtBtn").prop("disabled", false);
                            } else {
                                $(this).closest("tr").find(".addCmtBtn").prop("disabled", true);
                            }
                        });
                        console.log(data.responseText);
                        $("#alertTxt").html(
                            "An error has occurred! Please contact an admin or try again.");
                        $(".editAlert").fadeIn();
                        setTimeout(function () {
                            $(".editAlert").fadeOut();
                        }, 5000);
                    }
                });
            }
        });

        // cancel edit task or delete task
        $(".currentTasks").on("click", ".delBtn", function () {
            var element = $(this);
            var index = $(this).data("index");
            if ($(this).html().indexOf("Delete") == -1) {
                var orig = $(this).closest("tr").find(".tasktxt").html();
                $(this).closest("tr").find(".taskinput").fadeOut(function () {
                    $(this).closest("tr").find(".editBtn").html(
                        "<i class='fas fa-edit'></i> Edit");
                    $(this).closest("tr").find(".editBtn").prop("disabled", false);
                    $(this).closest("tr").find(".delBtn").html(
                        "<i class='fas fa-trash-alt'></i> Delete");
                    $(this).closest("tr").find(".taskinput").val(orig);
                    $(this).closest("tr").find(".tasktxt").fadeIn();
                });
            } else {
                $(".currentTasks").find("button").prop("disabled", true);
                $(".addTskBtn").prop("disabled", true);
                $.ajax({
                    method: "get",
                    url: "/task/" + index,
                    success: function (data) {
                        if (totalTasks == 1) {
                            totalTasks = 0;
                            $(element).closest("table").find("thead").animate({
                                margin: "hide",
                                padding: "hide",
                                opacity: "hide",
                                height: "hide"
                            });
                            $(element).closest("table").find(".task" + index).animate({
                                margin: "hide",
                                padding: "hide",
                                opacity: "hide",
                                height: "hide"
                            }, function () {
                                $(".currentTasks").load(" .table");
                                $("#addTaskFrm").find("*").prop("disabled", false);
                            });
                        } else {
                            $(element).closest("table").find(".task" + index).animate({
                                margin: "hide",
                                padding: "hide",
                                opacity: "hide",
                                height: "hide"
                            }, function () {
                                $(".currentTasks").load(" .table");
                                $("#addTaskFrm").find("*").prop("disabled", false);
                                totalTasks = parseInt($("#totalTasks").html());
                            });
                        }
                    },
                    error: function (data) {
                        console.log(data.responseText);
                        $("#addTaskFrm").find("*").prop("disabled", false);
                        $(".taskinput").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".editBtn").prop("disabled", false);
                            } else {
                                $(this).closest("tr").find(".editBtn").prop("disabled", true);
                            }
                        });
                        $(".commentinput").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".editCmtBtn").prop("disabled",
                                    false);
                            } else {
                                $(this).closest("tr").find(".editCmtBtn").prop("disabled", true);
                            }
                        });
                        $(".addCmt").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".addCmtBtn").prop("disabled", false);
                            } else {
                                $(this).closest("tr").find(".addCmtBtn").prop("disabled", true);
                            }
                        });
                        $("#alertTxt").html(
                            "An error has occurred! Please contact an admin or try again.");
                        $(".editAlert").fadeIn();
                        setTimeout(function () {
                            $(".editAlert").fadeOut();
                        }, 5000);
                    }
                });
            }
        });

        // add new comment
        $(".currentTasks").on("click", ".addCmtBtn", function () {
            var element = $(this).closest("tr");
            $(this).prop("disabled", true);
            $(this).closest("tr").find(".addCmt").prop("disabled", true);
            var index = $(this).data("index");
            var comment = $(this).closest("tr").find(".addCmt").val();
            $(".currentTasks").find("button").prop("disabled", true);
            $(".addTskBtn").prop("disabled", true);
            $.ajax({
                method: "post",
                url: "/comment",
                data: {
                    task_id: index,
                    comment: comment
                },
                success: function (data) {
                    $(element).before($("<tr><td></td><td><div>" + comment + "</div></td><td>" +
                        username +
                        "</td><td>1 second ago</td><td class='text-center'><button class='btn btn-primary'><i class='fas fa-edit'></i> Edit</button></td><td class='text-center'><button class='btn btn-danger'><i class='fas fa-trash-alt'></i> Delete</button></td>"
                    ).hide().animate({
                        margin: "show",
                        padding: "show",
                        opacity: "show",
                        height: "show"
                    }, function () {
                        $(".currentTasks").load(" .table");
                        $("#addTaskFrm").find("*").prop("disabled", false);
                    }));
                },
                error: function (data) {
                    console.log(data.responseText);
                    $("#addTaskFrm").find("*").prop("disabled", false);
                    $(".taskinput").each(function () {
                        if (regex.test($(this).val())) {
                            $(this).closest("tr").find(".editBtn").prop("disabled", false);
                        } else {
                            $(this).closest("tr").find(".editBtn").prop("disabled", true);
                        }
                    });
                    $(".commentinput").each(function () {
                        if (regex.test($(this).val())) {
                            $(this).closest("tr").find(".editCmtBtn").prop("disabled",
                                false);
                        } else {
                            $(this).closest("tr").find(".editCmtBtn").prop("disabled", true);
                        }
                    });
                    $(".addCmt").each(function () {
                        if (regex.test($(this).val())) {
                            $(this).closest("tr").find(".addCmtBtn").prop("disabled", false);
                        } else {
                            $(this).closest("tr").find(".addCmtBtn").prop("disabled", true);
                        }
                    });
                    $("#alertTxt").html(
                        "An error has occurred! Please contact an admin or try again.");
                    $(".editAlert").fadeIn();
                    setTimeout(function () {
                        $(".editAlert").fadeOut();
                    }, 5000);
                }
            });
        });

        // edit comment
        $(".currentTasks").on("click", ".editCmtBtn", function () {
            var index = $(this).data("index");
            var element = $(this);
            var comment = $(this).closest("tr").find(".commentinput").val();
            var orig = $(this).closest("tr").find(".commenttxt").html();
            if ($(this).html().indexOf("Save") == -1) {
                $(this).closest("tr").find(".commenttxt").fadeOut(function () {
                    $(this).closest("tr").find(".editCmtBtn").html(
                        "<i class='fas fa-edit'></i> Save Edit");
                    $(this).closest("tr").find(".delCmtBtn").html(
                        "<i class='fas fa-ban'></i> Cancel Edit");
                    $(this).closest("tr").find(".commentinput").fadeIn();
                });
            } else {
                $(".currentTasks").find("button").prop("disabled", true);
                $(".addTskBtn").prop("disabled", true);
                $.ajax({
                    method: "post",
                    url: "/comment/" + index,
                    data: {
                        comment: comment,
                    },
                    success: function (data) {
                        $(element).closest("tr").find(".commentinput").fadeOut(function () {
                            $(element).closest("tr").find(".editCmtBtn").html(
                                "<i class='fas fa-edit'></i> Edit");
                            $(element).closest("tr").find(".delCmtBtn").html(
                                "<i class='fas fa-trash-alt'></i> Delete");
                            $(element).closest("tr").find(".commenttxt").html(
                                comment);
                            $(element).closest("tr").find(".commenttxt").fadeIn(
                                function () {
                                    $(".currentTasks").load(" .table");
                                    $("#addTaskFrm").find("*").prop("disabled", false);
                                });
                        });
                    },
                    error: function (data) {
                        $(element).closest("tr").find(".commentinput").fadeOut(function () {
                            $(element).closest("tr").find(".editCmtBtn").html(
                                "<i class='fas fa-edit'></i> Edit");
                            $(element).closest("tr").find(".delCmtBtn").html(
                                "<i class='fas fa-trash-alt'></i> Delete");
                            $(element).closest("tr").find(".commentinput").val(orig);
                            $(element).closest("tr").find(".commenttxt").fadeIn();
                            $("#addTaskFrm").find("*").prop("disabled", false);
                            $(".taskinput").each(function () {
                                if (regex.test($(this).val())) {
                                    $(this).closest("tr").find(".editBtn").prop("disabled", false);
                                } else {
                                    $(this).closest("tr").find(".editBtn").prop("disabled", true);
                                }
                            });
                            $(".commentinput").each(function () {
                                if (regex.test($(this).val())) {
                                    $(this).closest("tr").find(".editCmtBtn").prop("disabled",
                                        false);
                                } else {
                                    $(this).closest("tr").find(".editCmtBtn").prop("disabled", true);
                                }
                            });
                            $(".addCmt").each(function () {
                                if (regex.test($(this).val())) {
                                    $(this).closest("tr").find(".addCmtBtn").prop("disabled", false);
                                } else {
                                    $(this).closest("tr").find(".addCmtBtn").prop("disabled", true);
                                }
                            });
                        });
                        console.log(data.responseText);
                        $("#alertTxt").html(
                            "An error has occurred! Please contact an admin or try again.");
                        $(".editAlert").fadeIn();
                        setTimeout(function () {
                            $(".editAlert").fadeOut();
                        }, 5000);
                    }
                });
            }
        });

        // delete comment or cancel comment edit
        $(".currentTasks").on("click", ".delCmtBtn", function () {
            var element = $(this);
            var index = $(this).data("index");
            if ($(this).html().indexOf("Delete") == -1) {
                var orig = $(this).closest("tr").find(".commenttxt").html();
                $(this).closest("tr").find(".commentinput").fadeOut(function () {
                    $(this).closest("tr").find(".editCmtBtn").html(
                        "<i class='fas fa-edit'></i> Edit");
                    $(this).closest("tr").find(".editCmtBtn").prop("disabled", false);
                    $(this).closest("tr").find(".delCmtBtn").html(
                        "<i class='fas fa-trash-alt'></i> Delete");
                    $(this).closest("tr").find(".commentinput").val(orig);
                    $(this).closest("tr").find(".commenttxt").fadeIn();
                });
            } else {
                $(".currentTasks").find("button").prop("disabled", true);
                $(".addTskBtn").prop("disabled", true);
                $.ajax({
                    method: "get",
                    url: "/comment/" + index,
                    success: function (data) {
                        $(element).closest("table").find("#comment" + index).animate({
                            margin: "hide",
                            padding: "hide",
                            opacity: "hide",
                            height: "hide"
                        }, function () {
                            $(".currentTasks").load(" .table");
                            $("#addTaskFrm").find("*").prop("disabled", false);
                        });
                    },
                    error: function (data) {
                        console.log(data.responseText);
                        $("#addTaskFrm").find("*").prop("disabled", false);
                        $(".taskinput").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".editBtn").prop("disabled", false);
                            } else {
                                $(this).closest("tr").find(".editBtn").prop("disabled", true);
                            }
                        });
                        $(".commentinput").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".editCmtBtn").prop("disabled",
                                    false);
                            } else {
                                $(this).closest("tr").find(".editCmtBtn").prop("disabled", true);
                            }
                        });
                        $(".addCmt").each(function () {
                            if (regex.test($(this).val())) {
                                $(this).closest("tr").find(".addCmtBtn").prop("disabled", false);
                            } else {
                                $(this).closest("tr").find(".addCmtBtn").prop("disabled", true);
                            }
                        });
                        $("#alertTxt").html(
                            "An error has occurred! Please contact an admin or try again.");
                        $(".editAlert").fadeIn();
                        setTimeout(function () {
                            $(".editAlert").fadeOut();
                        }, 5000);
                    }
                });
            }
        });

        //disable edit button if edit task input is empty or invalid
        $(".currentTasks").on("input", ".taskinput", function () {
            if (regex.test($(this).val())) {
                $(this).closest("tr").find(".editBtn").prop("disabled", false);
            } else {
                $(this).closest("tr").find(".editBtn").prop("disabled", true);
            }
        });

        //disable edit button if edit comment input is empty or invalid
        $(".currentTasks").on("input", ".commentinput", function () {
            if (regex.test($(this).val())) {
                $(this).closest("tr").find(".editCmtBtn").prop("disabled", false);
            } else {
                $(this).closest("tr").find(".editCmtBtn").prop("disabled", true);
            }
        });

        //disable add comment button if add comment input is empty or invalid
        $(".currentTasks").on("input", ".addCmt", function () {
            if (regex.test($(this).val())) {
                $(this).closest("tr").find(".addCmtBtn").prop("disabled", false);
            } else {
                $(this).closest("tr").find(".addCmtBtn").prop("disabled", true);
            }
        });
    </script>
</body>

</html>