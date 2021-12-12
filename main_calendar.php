<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf8">
        <title>Agenda</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="calendar/fullcalendar.css" />
        <link rel="stylesheet" href="calendar/bootstrap.css" />
        <script src="calendar/jquery.min.js"></script>
        <script src="calendar/jquery-ui.min.js"></script>
        <script src="calendar/moment.min.js"></script>
        <script src="calendar/fullcalendar.min.js"></script>
        <script>
            $(document).ready(function() {
                var calendar = $('#calendar').fullCalendar({

                    editable:true,
                    header:{
                        left:'prev,next today',
                        center:'title',
                        right:'month,agendaWeek,agendaDay'
                    },
                    events: 'load.php',
                    selectable:true,
                    selectHelper:true,
                })
            });
        </script>
    </head>
    <body>
        <nav class = "navtop">
            <div>
                <h1>Dental Corner</h1>
                <a href="main_calendar.php"><i class ="gg-calendar-today"></i>L'agenda</a>
                <a href="index.php"><i class ="gg-home-alt"></i>Rendez-vous</a>
            </div>
        </nav>
        <div class="container">
            <div id="calendar"></div>
        </div>

    </body>
</html>