<?php
namespace Htmlacademy\Actions;

use Htmlacademy\Exceptions\UserException;

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

    public function __construct(string $status, int $ownerId, ?int $performerId, string $dateEnd) {
        if (!in_array($status, self::STATUSES)) {
            throw new UserException("Cтатуса $status не существует.");
        }

        if ($ownerId < 0 || $performerId < 0) {
            throw new UserException("Некорректный идентификатор пользователя или заказчика.");
        }

        $this->status = $status;
        $this->ownerId = $ownerId;
        $this->performerId = $performerId;
        $this->dateEnd = $dateEnd;
    }

    public function getStatus(): string {
        return $this->status;
    }
    public function getPerformerId(): ?int {
        return $this->performerId;
    }
    public function getUserId(): int {
        return $this->ownerId;
    }
    public function getStatuses(): array {
        return self::STATUSES;
    }
    public function getActions(): array {
        return self::ACTIONS;
    }

    public function getNextStatus(string $action): string {
        if (!in_array($action, $this->getActions())) {
            throw new UserException("Действия $action не существует.");
        }

        if (!class_exists($action)) {
            throw new UserException("Класса $action не существует.");
        }

        return self::ACTIONS_MAP[$action] ?? $this->status;
    }

    public function getAvailableActions(int $userId, string $userRole): array {
        $result = [];
        if (!in_array($userRole, self::ROLES)) {
            throw new UserException("Роли пользователя $userRole не существует.");
        }
        foreach ($this->getActions() as $action) {
            if (!class_exists($action)) {
                throw new UserException("Класса $action не существует.");
            }

            if (!method_exists($action, "checkUserAccess")) {
                throw new UserException("Корректного метода в классе $action не существует.");
            }

            if ($action::checkUserAccess($userId, $userRole, $this)) {
                $result[] = $action;
            }
        }
        return $result;
    }
}
