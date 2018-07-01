<?php

return [
	'mysql' => [
		'host' => 'localhost',
		'dbname' => 'faq',
		'user' => 'root',
		'pass' => '',
	]
];
//вынесу в отдельный файл
<?php

class DataBase {
	public static function connect ($host, $dbname, $user, $pass) {
		try {
			$db = new PDO('mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8', $user, $pass);
		}
		catch (PDOException $e) {
			die('Database error: '.$e->getMessage().'<br>');
		}
		
		return $db;
	}
}
