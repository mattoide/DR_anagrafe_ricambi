<!DOCTYPE html>
<html lang="it">
<head>
    <title>Anagrafe Ricambi</title>

    <link rel="stylesheet" href="style.css" media="screen">

    <script>
        function restart() {
            window.location.href = "select_action_page.php";
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
            <tr class="<?=$params[1] == null || $params[2] == null || $params[3] == null || $params[4] == null || $params[5] == null  ? 'row-error' : ''?>">


                <td class="<?=$params[0] == null ? 'cell-error' : ''?>"><?php echo $params[0] ?> </td>
                <td class="<?=$params[1] == null ? 'cell-error' : ''?>"><?php echo $params[1] ?></td>
                <td class="<?=$params[2] == null ? 'cell-error' : ''?>"><?php echo $params[2] ?></td>
                <td class="<?=$params[3] == null ? 'cell-error' : ''?>"><?php echo $params[3] ?></td>
                <td class="<?=$params[4] == null ? 'cell-error' : ''?>"><?php echo $params[4] ?></td>
                <td class="<?=$params[5] == null ? 'cell-error' : ''?>"><?php echo $params[5] ?></td>

            </tr>

        <?php } ?>
    </table>


</div>


<div class="centered-div">

<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
      enctype="multipart/form-data">

<!--    <label class="row-error label">Le righe di questo colore non verranno inserite <span class="cell-error label">a causa di questi campi mancanti</span></label>-->
<!--    <span> <label class="cell-error">a causa di questi campi mancanti</label></span>-->

    <label class="label">Le righe gialle non verranno inserite, a causa dei campi mancanti (in rosso) </label>
    <br>
    <?php

    if ($error_message != null ){
        echo"<input type='button' class='error button-error' value='$error_message' onclick='restart()'>";
    }

     if($error_message == null && $success_message == null ){
         echo " <input class='button' type='submit' value='Conferma $action' name='submit'>";
     };

    if ($success_message != null ){
        echo"<input type='button' class='success button-success' value=' $success_message ' onclick='restart()'>";
    }
    ?>




</form>
</div>

</body>
</html>
