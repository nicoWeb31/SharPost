<?php 
ob_start() 
?>




<?php 
$content =ob_get_clean();
$titre = $data['title'] ;
$description = $data['description'];
require APPROOT."/views/inc/template.html.php";
?>