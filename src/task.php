<?php
namespace Htmlacademy;

class Task {
	private $actions = ["create", "start", "approve", "cancel", "degree"];
    private $statuses = ["new", "started", "done", "canceled", "failed"];
	private $status = "";
	private $userId = 0;
	private $clientId = 0;
	private $dateEnd = "";
	private function setStatus($status) {
		$this->status = $status;
	}
	public function __construct($userId, $clientId, $date) {
		$this->userId = $userId;
		$this->clientId = $clientId;
		$this->dateEnd = $date;
	}
	public function setAction($action) {
		if ($action === $this->actions[0]) {
			$this->setStatus($this->statuses[0]);
		} elseif ($action === $this->actions[1]) {
			$this->setStatus($this->statuses[1]);
		} elseif ($action === $this->actions[2]) {
			$this->setStatus($this->statuses[2]);
		} elseif ($action === $this->actions[3]) {
			$this->setStatus($this->statuses[3]);
		} elseif ($action === $this->actions[4]) {
			$this->setStatus($this->statuses[4]);
		} else {
			$this->setStatus("Ошибка: такое действие не предусмотрено");
		}
	}
	public function getStatus() {
		return $this->status;
	}
	public function getStatuses() {
		return $this->statuses;
	}
	public function getActions() {
		return $this->actions;
	}
	public function getdateEnd() {
		return $this->dateEnd;
	}
}
