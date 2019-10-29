<?php
namespace Htmlacademy;

class Task {
	private $actions = ["start", "approve", "cancel", "degree"];
    private $statuses = ["started", "done", "canceled", "failed"];
	private $status = "";
    private $message = "";
	private $userId = 0;
	private $clientId = 0;
	private $dateEnd = "";
	private function setStatus($status) {
		$this->status = $status;
	}
    private function setMessage($message) {
		$this->message = $message;
	}
	public function __construct($userId, $clientId, $date) {
		$this->userId = $userId;
		$this->clientId = $clientId;
		$this->dateEnd = $date;
        $this->status = "new";
	}
	public function setAction($action) {
        if (!in_array($action, $this->actions)) {
            $this->setMessage("Ошибка: действие не предусмотрено.");
            return false;
        }
        $this->setMessage("");
        if ($this->status === "new") {
            if ($action === $this->actions[0]) {
			    $this->setStatus($this->statuses[0]);
		    } elseif ($action === $this->actions[2]) {
			    $this->setStatus($this->statuses[2]);
		    } else {
                $this->setMessage("Ошибка: вы не можете выполнить это действие над новым заданием.");
                return false;
            }
        } elseif ($this->status === $this->statuses[0]) {
            if ($action === $this->actions[1]) {
			    $this->setStatus($this->statuses[1]);
		    } elseif ($action === $this->actions[3]) {
			    $this->setStatus($this->statuses[3]);
		    } else {
			    $this->setMessage("Ошибка: вы не можете выполнить это действие над заданием в статусе &#171;на исполнении&#187;.");
                return false;
		    }
        } else {
            $this->setMessage("Ошибка: вы не можете выполнить это действие над заданием в статусе &#171;провалено&#187;, &#171;отменено&#187; или &#171;завершено&#187;.");
            return false;
        }
        return true;
	}
	public function getStatus() {
		return $this->status;
	}
    public function getMessage() {
		return $this->message;
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
