<?php
 include_once "header.php"
  
 $sleeps = $db->GetSleepData();
?>

<body>
 <?php printr($sleeps); ?>
</body>





