<?php
    function pdo_connect_mysql(){
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'dental_corner';
        
        try{
            return new PDO('mysql:host='. $DATABASE_HOST .';dbname ='. $DATABASE_NAME .'; charset=utf8',$DATABASE_USER,$DATABASE_PASS);
        }catch(PDOException $exception){

            exit('Connection Failed');

        }
    }
    function template_header($title){
        echo <<<EOT
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset = "utf8">
                <title>$title</title>
                <link rel="stylesheet" type="text/css" href="tables/datatables.min.css"/>
                <script src="tables/jquery.js"></script>
                <script src="tables/datatables.min.js"></script>
                <link href="style.css" rel="stylesheet" type="text/css">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
            </head>
            <body>
                <nav class = "navtop">
                    <div>
                        <h1>Dental Corner</h1>
                        <a href="index.php"><i class ="fas fa-home"></i>Rendez-vous</a>
                    </div>
                </nav>
        EOT;
    }
    function template_footer(){
        echo <<<EOT
            </body>
        </html>
        EOT;
    }
?>