<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

$sqlquery = "select * from projeto_individual.departamento";
$resultQuery = mysqli_query($conn, $sqlquery);

if ($resultQuery->num_rows > 0) {
    while ($row = $resultQuery->fetch_assoc()) {
        // Substitui 1 e 0 por "Sim" e "Não"
       
        echo "<option value='" . htmlspecialchars($row['idDepartamento']) . "'>" . htmlspecialchars($row['Departamento']) . "</option>";

    }
} else {
    echo "Nenhum Departamento encontrado.";
}



?>