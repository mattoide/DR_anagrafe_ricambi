<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css" media="screen">

    <?php
    $action = "inserimento";
    include "../load.php"
    ?>

    <script>
        function restart() {
            window.location.href = "../select_action_page.php";
        }

    </script>
</head>
<body>

<form class="centered" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
      enctype="multipart/form-data">
<!--    <div>-->
<!--        <button style="background: gray" type="button" value="Ricomincia" onclick="restart()">-->
<!--            <span class=reload>&#x21bb;</span>-->
<!--        </button>-->
<!--    </div>-->

    <h1 class="title">INSERIMENTO</h1>
    <h2 class="title">Carica file</h2>
    <input type="file" name="fileToUpload" id="fileToUpload" accept=".xls,.xlsx,.ods">
    <span class="error">  <?php echo $error_message; ?></span>
    <br>
    <input class="button" type="submit" value="Carica" name="submit">
</form>

</body>
</html>




