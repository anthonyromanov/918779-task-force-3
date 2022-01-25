<?php

namespace  Taskforce;
use Taskforce\Exceptions\CustomException;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_WORKING = 'working';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';

    public const CUSTOMER = 'customer';
    public const EXECUTOR = 'executor';

    public const NEXT_STATUS = [
        CancelAction::ACTION_CANCEL => self::STATUS_CANCELED,
        RespondAction::ACTION_RESPOND => self::STATUS_WORKING,
        DoneAction::ACTION_DONE => self::STATUS_DONE,
        RefusedAction::ACTION_REFUSED => self::STATUS_FAILED,
    ];

    public const ALLOWED_ACTIONS = [
        self::STATUS_NEW => [
            self::CUSTOMER => CancelAction::ACTION_CANCEL,
            self::EXECUTOR => RespondAction::ACTION_RESPOND,
        ],
        self::STATUS_WORKING => [
            self::CUSTOMER => DoneAction::ACTION_DONE,
            self::EXECUTOR => RefusedAction::ACTION_REFUSED,
        ],
    ];

    public static $mapStatuses = [

        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCELED => 'Отменено',
        self::STATUS_WORKING => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAILED => 'Провалено'

    ];

    public static $mapActions = [

        CancelAction::ACTION_CANCEL => 'Отменить задание',
        RespondAction::ACTION_RESPOND => 'Откликнуться на задание',
        DoneAction::ACTION_DONE => 'Задание выполнено',
        RefusedAction::ACTION_REFUSED => 'Отказаться от задания'

    ];

    private $idUser;

    private function setIdCustomer ($idUser) {

        $this->idCustomer = $idUser;

    }

    private function setIdExecutor ($idUser) {

        $this->idExecutor = $idUser;

    }

    public function __construct(int $idExecutor, int $idCustomer = null) {

        $this->setIdCustomer($idCustomer);
        $this->setIdExecutor($idExecutor);

    }

    public static function getMapStatuses(): array {

        return self::$mapStatuses;

    }

    public static function getMapActions(): array {

        return self::$mapActions;

    }

    public function getStatusByAction(string $action) {

        return self::NEXT_STATUS[$action->getInternalName()] ?? '';

    }

    public function getAllowedAction(string $status, string $action) {

        if ($status !== STATUS_NEW && $status !== STATUS_WORKING) {

        throw new CustomException ('Нет доступных действий для этого статуса');

        }

        return self::ALLOWED_ACTIONS[$status][$action->checkRights()] ?? [];

    }

}

?>
