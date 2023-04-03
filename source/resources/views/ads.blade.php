<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />




        <!-- Styles -->
        <style>
            .input-box {
                border-width: 10px;
                border-color: black;
            }           
        </style>
        <script  src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
    </head>

    <body>

        {{--    
        {{dump($text)}}
        --}}


        
        <div class="input-box">
            <textarea class="ad" name="text" cols="100" rows="30" >{{$text}}</textarea>
        </div>

        <button type='button' value="ad_text" title="Proceed to Checkout" class="btn-checkout">
            <span>Сохранить объявление</span>
        </button>


        <script>

            let path = null;
            let button = document.getElementsByClassName('btn-checkout')[0];
            let param = document.location.pathname.split('/').splice(-1)[0];

            param === 'new' ? path = "/ads/new" : path = "/ads/update";
            console.log(param,path);




            button.addEventListener('click',function(){

                let text = document.getElementsByClassName('ad')[0].value;

                $.ajax({
                    type: "POST",
                    url: path,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: param,
                        data: text,
                    },
                    success: function(msg) {
                        console.log(msg);
                        document.location = '/dashboard';
                    },
			    });

            });


        </script>


    </body>

</html>
