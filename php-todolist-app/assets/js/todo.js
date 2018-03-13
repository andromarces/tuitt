// check off specific to dos by clicking

$("ul").on("click", "li", function () {
    $(this).toggleClass("completed");

    $.post('assets/done.php', {
            id: $(this).attr('id')
        },
        function (data, status) {});
});

$('#newTask').keypress(function (event) {
    if (event.which == 13) {
        var todoText = $(this).val();

        $.post('assets/create.php', {
            task: todoText
        }, function (data, status) {
            $('ul').append('<li class="list-group-item p-0" id="' + data + '"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt" data-fa-transform="down-1"></i></button><strong>' + todoText + '</strong></li>')
        });
    }
});

$('div.input-group-append').click(function () {
    var enter = jQuery.Event("keypress");
    enter.which = 13;
    $('#newTask').trigger(enter);
});

// deleting a task
$('ul').on('click', 'button', function () {
    // remove  list item from DOM
    $(this).parent().fadeOut(500, function () {
        $(this).remove();
    });



    //ajax request to update JSON
    $.post('assets/delete.php', {
        id: $(this).parent().attr('id')
    }, function (data, status) {
        // console.log(data);
    });
});