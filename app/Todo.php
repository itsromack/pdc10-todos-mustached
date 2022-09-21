<?php

namespace App;
use \PDO;

class Todo
{
	protected $id;
	protected $task;
	protected $is_completed;
	protected $completed_at;

	// Database Connection Object
	protected $connection;

	public function __construct($task, $is_completed = 0)
	{
		$this->task = $task;
		$this->is_completed = $is_completed;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTask()
	{
		return $this->task;
	}

	public function isCompleted()
	{
		return $this->is_completed == 1;
	}

	public function getDateCompleted()
	{
		return $this->completed_at;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO todos SET task=:task, is_completed=:is_completed";
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':task' => $this->getTask(),
				':is_completed' => $this->isCompleted()
			]);
			$this->id = $this->connection->lastInsertId();
			return $this;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM todos WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->task = $row['task'];
			$this->is_completed = $row['is_completed'];
			$this->completed_at = $row['completed_at'];

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($task, $is_completed)
	{
		try {
			$sql = 'UPDATE todos SET task=?, is_completed=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$task,
				$is_completed,
				$this->getId()
			]);
			$this->task = $task;
			$this->is_completed = $is_completed;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM todos WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$sql = 'SELECT * FROM todos';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}