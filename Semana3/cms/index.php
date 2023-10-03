<html>
    <head>
        <style>
            body{background:blue;}
            form{
                width:300px;height:300px;padding:30px;margin:auto;background:grey;box-shadow:5px 15px 25px black;border-radius:20px;}
            input{width:100%;margin-top:15px;margin-bottom:15px;border:0px;padding-top:15px;border-radius:5px}
        </style>
    </head>
    <body>
        <form action="login.php" method="POST">
            <input type="text" name="Usuario">
            <input type="password" name="password">
            <input type="submit">
        </form>
    </body>
</html>