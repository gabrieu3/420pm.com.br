<?php
include("..\db.php");

$db = new DbConnection();
$conn = $db->getDBConnect();

echo 'teste DbConnection';


