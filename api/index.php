<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/todos', 'getTodos');
$app->get('/todos/:id',	'getTodo');
$app->post('/todos', 'addTodo');
$app->put('/todos/:id', 'updateTodo');
$app->delete('/todos/:id',	'deleteTodo');

$app->run();

function getTodos() {
	$sql = "select * FROM todos ORDER BY id";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$todos = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"todos": ' . json_encode($todos) . '}';
	} catch(PDOException $e) {
		echo 'error : '. $e->getMessage();  
	}
}

function getTodo($id) {
	$sql = "SELECT * FROM todos WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$todo = $stmt->fetchObject();  
		$db = null;
		echo json_encode($todo); 
	} catch(PDOException $e) {
		$response = Slim::getInstance()->response();
		$response->status(404);
		$response->write('error : '. $e->getMessage());
		echo $response->finalize();
	}
}

function addTodo() {
	error_log('addTodo\n', 3, '/var/tmp/php.log');
	$request = Slim::getInstance()->request();
	$todo = json_decode($request->getBody());
	
	if ($todo->description!='') {
		$sql = "INSERT INTO todos (description, priority, due_date, status) VALUES (:description, :priority, :due_date, :status)";

		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);  
			$stmt->bindParam("description", $todo->description);
			$stmt->bindParam("priority", $todo->priority);
			$stmt->bindParam("due_date", $todo->due_date);
			$stmt->bindParam("status", $todo->status);
			$stmt->execute();
			$todo->id = $db->lastInsertId();
			$db = null;
			echo json_encode($todo); 
		} catch(PDOException $e) {
			$response = Slim::getInstance()->response();
			$response->status(400);
			$response->write('error : '. $e->getMessage());
			echo $response->finalize();
		}
	} else {
		$response = Slim::getInstance()->response();
		$response->status(400);
		$response->write('Description cannot  be empty');
		echo $response->finalize();

	}
}

function updateTodo($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$todo = json_decode($body);

	if ($todo->description!='') {
		$sql = "UPDATE todos SET description=:description, priority=:priority, due_date=:due_date, status=:status WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);  
			$stmt->bindParam("description", $todo->description);
			$stmt->bindParam("priority", $todo->priority);
			$stmt->bindParam("due_date", $todo->due_date);
			$stmt->bindParam("status", $todo->status);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			echo json_encode($todo); 
		} catch(PDOException $e) {
			$response = Slim::getInstance()->response();
			$response->status(400);
			$response->write('error : '. $e->getMessage());
			echo $response->finalize();
		}
	} else {
		$response = Slim::getInstance()->response();
		$response->status(400);
		$response->write('Description cannot  be empty');
		echo $response->finalize();

	}
}

function deleteTodo($id) {
	$sql = "DELETE FROM todos WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
	} catch(PDOException $e) {
			$response = Slim::getInstance()->response();
			$response->status(500);
			$response->write('error : '. $e->getMessage());
			echo $response->finalize();
	}
}


function getConnection() {
	$dbhost="127.0.0.1";
	$dbuser="root";
	$dbpass="pass";
	$dbname="dust_slim_example";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>