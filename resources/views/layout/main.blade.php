<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HaaS | Lolita</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <style type="text/css">

            .calendar {
                width: 100%;
            }
            .calendar, .calendar table {
                border: 0;
                margin: 0;
            }
            .calendar, .calendar table, .calendar td {
                text-align: center;

            }
            .year{
                font-family:Verdana; 
                font-size:18pt; 
                color:#ff9900;
            }
            .calendar .month{
                width: 25%;
                vertical-align: top;
            }
            .calendar .month table{
                font-size:10pt;
                font-family:Verdana;
            }
            .calendar .month th{
                text-align: center;
                font-size:12pt;
                font-family:Arial;
                color:#666699;
            }
            .calendar .month td{
                font-size:10pt;
                font-family:Verdana;
                height: 40px !important;
                width: 30px !important;
                padding: 5px;
                color: white;
            }
            .calendar .month .days td{
                color:#666666;
                font-weight: bold;
            }

            /*RGB Gradient*/
            .calendar .month .score_1{
                background:#ff0000;
            }
            .calendar .month .score_2{
                background:#ea1500;
            }
            .calendar .month .score_3{
                background:#d42b00;
            }
            .calendar .month .score_4{
                background:#bf4000;
            }
            .calendar .month .score_5{
                background:#aa5500;
            }
            .calendar .month .score_6{
                background:#55aa00;
            }
            .calendar .month .score_7{
                background:#40bf00;
            }
            .calendar .month .score_8{
                background:#2bd400;
            }
            .calendar .month .score_9{
                background:#15ea00;
            }
            .calendar .month .score_10{
                background:#00ff00;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <br>
            <div class="text-center"><h1>Horoscope-as-a-Service by <i>Lolita</i></h1></div>
            <hr>
            <br>
            @yield('content')
        </div>
        
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
    </body>
</html>
