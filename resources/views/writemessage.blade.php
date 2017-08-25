<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <div class="containter">
            <div class="row">
                <div id="message"></div>
            </div>
        </div>

        <div class="containter">
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="message" id="message1">
                <input type="button" value="send" id="button-submit">
            </div>
        </div>
    </body>
</html>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script>
    $( document ).ready(function() {
        $("#button-submit").on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });

            var data = {
                "content" : $("#message1").val()
            };

            $.ajax({
                url: '/sendmessage',
                type: "post",
                dataType: "text",
                data: data,
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    console.log(0);
                }
            });
        });
        var socket = io.connect('http://127.0.0.1:8890');
        console.log('connected..');
        socket.on('chat', function(data) {
            console.log(data);
            $('#message').append("<p>" + data + "</p>");
        });
    });
</script>

