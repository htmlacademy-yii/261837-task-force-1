<?php
namespace Htmlacademy\Actions;

class AvailableActions {
    const STATUS_NEW = "new";
    const STATUS_PROCESSING = "processing";
    const STATUS_CANCELED = "canceled";
    const STATUS_FINISHED = "finished";
    const STATUS_FAILED = "failed";

    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_PROCESSING,
        self::STATUS_CANCELED,
        self::STATUS_FINISHED,
        self::STATUS_FAILED,
    ];

    const ACTIONS = [
        AcceptAction::class,
        RespondAction::class,
        RefuseAction::class,
        CancelAction::class,
        FinishAction::class,
        ChatAction::class,
    ];

    const ACTIONS_MAP = [
        AcceptAction::class => self::STATUS_PROCESSING,
        CancelAction::class => self::STATUS_CANCELED,
        RefuseAction::class => self::STATUS_FAILED,
        FinishAction::class => self::STATUS_FINISHED,
    ];

    const OWNER = "owner";
    const PERFORMER = "performer";
    const OTHER = "other";

    const ROLES = [
        self::OWNER,
        self::PERFORMER,
        self::OTHER,
    ];

    private $ownerId;
    private $status;
    private $performerId;
    private $dateEnd;

    public function __construct($status, $ownerId, $performerId, $dateEnd) {
        $this->status = $status;
        $this->ownerId = $ownerId;
        $this->performerId = $performerId;
        $this->dateEnd = $dateEnd;
    }

    public function getStatus() {
        return $this->status;
    }
    public function getPerformerId() {
        return $this->performerId;
    }
    public function getUserId() {
        return $this->ownerId;
    }
    public function getStatuses() {
        return self::STATUSES;
    }
    public function getActions() {
        return self::ACTIONS;
    }

    public function getNextStatus($action) {
        return self::ACTIONS_MAP[$action] ?? $this->status;
    }

    public function getAvailableActions($userId, $userRole) {
        $result = [];
        foreach ($this->getActions() as $action) {
            if ($action::checkUserAccess($userId, $userRole, $this)) {
                $result[] = $action;
            }
        }
        return $result;
    }
}
