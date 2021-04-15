<?php

include 'DatabaseContext.php';

class DatabaseConnection
{
	private $servername,	$database, $username, $password;
	public $connection;

	private $context;

	public function __construct($servername, $database, $username, $password)
	{
		$this->servername = $servername;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;

		$this->connection = new mysqli($this->servername, $this->username, $this->password);

		$this->context = new DatabaseContext($this->connection);

		mysqli_select_db($this->connection, $this->database);
	}

	public function __destruct()
	{
		mysqli_close($this->connection);
	}

	public function getContext()
	{
		return $this->context;
	}

	public function getConnectionStatus()
	{
		return $this->connection->connect_error;
	}
}
