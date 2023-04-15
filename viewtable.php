<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" media="screen">

    <script>
        function restart() {
            window.location.href = "../select_action_page.php";
        }

    </script>
</head>
<body>

<?php
include "call_procedure.php";
$action = $_GET['action'];
?>


<div class='table-centered'>
    <table border='1' cellpadding='10'>

        <tr>

            <th>Descrizione</th>
            <th>Descrizione</th>
            <th>Codice</th>
            <th>Modello</th>
            <th>1</th>
            <th>Alias</th>

        </tr>


        <?php for ($i = 0; $i < count($proc_params); ++$i) {
            $params = explode("%--%", $proc_params[$i]);
            ?>
            <tr>

                <td><?php echo $params[0] ?> </td>
                <td><?php echo $params[1] ?></td>
                <td><?php echo $params[2] ?></td>
                <td><?php echo $params[3] ?></td>
                <td><?php echo $params[4] ?></td>
                <td><?php echo $params[5] ?></td>

            </tr>

        <?php } ?>
    </table>


</div>


<div class="centered-div">

<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
      enctype="multipart/form-data">

    <input class="button" type="submit" value="Conferma <?php echo $action ?>" name="submit">

</form>
</div>

</body>
</html>
