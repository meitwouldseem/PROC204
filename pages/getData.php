<?php
include_once "header.php";

$sleeps = $db->GetSleepData();
?>

<body>
<?php print_r($sleeps); ?>
</body>





