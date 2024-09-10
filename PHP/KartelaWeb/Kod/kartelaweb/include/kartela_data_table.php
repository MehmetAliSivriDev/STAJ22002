<?php 
    $kartelaData = $_SESSION["KartelaData"];

?>

<table class="table table-hover table-striped mt-5">
        <tr class="table-success">
            <th>Bar</th>
            <th>Varyant</th>
            <th>Desen</th>
            <th>Com</th>
            <th>Desen Kod</th>
            <th>Kg</th>
            <th>En</th>
            <th>Renk</th>
            <th>Tip</th>
            <th>KEn</th>
        </tr>
        <?php 
            foreach ($kartelaData as $data) {
                echo "<tr>";
                echo "<td>$data[Bar]</td>";
                echo "<td>$data[Varyant]</td>";
                echo "<td>$data[Desen]</td>";
                echo "<td>$data[DesenKod]</td>";
                echo "<td>$data[Kg]</td>";
                echo "<td>$data[En]</td>";
                echo "<td>$data[Desen]</td>";
                echo "<td>$data[Renk]</td>";
                echo "<td>$data[Tip]</td>";
                echo "<td>$data[KEn]</td>";
                echo "</tr>";
            }
        ?>

</table>