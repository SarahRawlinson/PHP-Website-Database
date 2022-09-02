<?php
require 'DatabaseConnection.php';
$dbConnect = DatabaseConnection::GetInstance();
$ProjectPageFromDB = "";
$result = $dbConnect->GetLanguages();
print_r($result);
?>