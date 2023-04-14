<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" media="screen">
</head>
<body>
<?php

$proc_params = $_GET['proc_params'];
$action = $_GET['action'];

$proc_params = json_decode($proc_params);

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
    <input class="button " type="submit" value="Conferma <?php echo $action ?>" name="submit">
</div>


</body>
</html>
