<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AlphaComodate') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <link href="css/bootstrap.min.css" rel="stylesheet">

     <!-- Icons -->
     <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

     <style>
         /* <a style="text-decoration: none;"></a> */
         /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
        }
        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper {
            height: 600px;
        }
        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }
        .user:hover {
            background: #eeeeee;
        }
        .user:last-child {
            margin-bottom: 0;
        }
        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }
        .media-body p {
            margin: 6px 0;
        }
        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }
        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #575555;
            color:white;
        }
        .sent {
            background: #180e29;
            float: right;
            text-align: right;
            color:white;
        }
        .message p {
            margin: 5px 0;
        }
        .date {
            color: #777777;
            font-size: 12px;
        }
        /* .active {
            background: #eeeeee;
        } */
        /* input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }
        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        } */
     </style>
     <script>
         $('#myModal').modal('show');
// www.jquery2dotnet.com
         </script>

    
</head>
<body>
    <div id="app">
       
        <main class="py-4">
            @include('inc.navbar')
            <div class="container">
                @include('inc.messages')
            @yield('content')
            @include('inc.footbar')
        </main>
    </div>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script >
        CKEDITOR.replace('summary-ckeditor');
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvxoZdoTf5GcBFXLOWKVI_jElP7mlU-28&libraries=places"></script>
<script>
    function initialize() {
      var input = document.getElementById('searchTextField');
      var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2').value = place.name;
            document.getElementById('cityLat').value = place.geometry.location.lat();
            document.getElementById('cityLng').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>


<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('7c785cb5029cb77df072', {
            cluster: 'eu',
            
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
            //alert(JSON.stringify(data));
            if (my_id == data.user_id){
                alert('sender')
            }else if(my_id == data.reciever_id){
                if (receiver_id == data.user_id) {
                    // if receiver is selected, reload the selected user ...
                    $('#' + data.user_id).click();
                } else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.user_id).find('.pending').html());
                    if (pending) {
                        $('#' + data.user_id).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.user_id).append('<span class="pending">1</span>');
                    }
                }
            }

            
            });

        $('.user').click(function(){
            $('.user').removeClass('active');
            $(this).addClass('active');

            receiver_id = $(this).attr('id');
            // alert(receiver_id);
            $.ajax({
                type: "get",
                url: "message/" + receiver_id,//create route
                data:"",
                cache: false,
                success: function (data){
                    $('#message').html(data);
                    // alert(data);
                }
            });
        });

        $(document).on('keyup', '.input-text input', function (e){
            var message = $(this).val();
            if(e.keyCode == 13 && message != '' && receiver_id !=''){
                $(this).val('');
                // alert(message);
                var datastr = "receiver_id=" + receiver_id + "&message="+message;
                $.ajax({
                    type: "post",
                    url: "message",
                    data: datastr,
                    cache: false,
                    success: function (data) {
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
              //  alert(datastr);
            }
        })
   
   
    });

    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
        // ajax setup form csrf token

</script>
</body>
</html>
