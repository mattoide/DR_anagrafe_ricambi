<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" media="screen">

    <script>
        function insert(){
            window.location.href = "insert/upload_for_insert_page.php";
        }

        function update(){
            window.location.href = "update/upload_for_update_page.php";

        }
    </script>
</head>
<body>

<div class="centered" >
    <h2 class="title">Scegli l'azione da compiere</h2>

    <input class="button" style="color: black"  type="button" value="INSERIMENTO" onclick="insert()">
    <br>
    <input class="button" style="background: #eeff94; color: black" type="button" value="AGGIORNAMENTO" onclick="update()" >

</div>

<?php
function insert(){
    header("Location: upload_for_insert_page.php");
}

function update(){
    header("Location: upload_for_update_page.php");
}

?>

</body>

</html>