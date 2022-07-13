<?php 
include_once('conexion_sqlsrv.php');
?>

<?php

/* $prueba = $_GET['id_card'];
print_r($prueba);
 */
$id_card = isset($_GET['card_id']) ? trim($_GET['card_id']) : '';
//echo $id_card;

$query_search = "SELECT * FROM employees WHERE id_card = :id_card";
$stmt_search = $conn->prepare($query_search);
$stmt_search->bindParam(':id_card', $id_card, PDO::PARAM_STR);
$stmt_search->execute();
$result[] = $stmt_search->fetch(PDO::FETCH_ASSOC);

echo json_encode($result); 

?>