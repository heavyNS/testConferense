
<?php
 require_once 'connection.php';
 include 'sql_commands.php';
 require_once 'conf_class.php';
$confs[] = $conn->query(SQL_GET_ALL_ELEMENTS)->fetchObject('Conf');

foreach($confs as $o){
	echo $o->get_title();
}


?>