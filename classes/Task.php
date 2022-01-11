<?php

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_WORKING = 'working';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';

    const ACTION_CANCEL = 'cancel';
    const ACTION_RESPOND = 'respond';
    const ACTION_DONE = 'done';
    const ACTION_REFUSED = 'refused';

    public const CUSTOMER = 'customer';
    public const EXECUTOR = 'executor';

    public const NEXT_STATUS = [
        self::ACTION_CANCEL => self::STATUS_CANCELED,
        self::ACTION_RESPOND => self::STATUS_WORKING,
        self::ACTION_DONE => self::STATUS_DONE,
        self::ACTION_REFUSED => self::STATUS_FAILED,
    ];

    public const ALLOWED_ACTIONS = [
        self::STATUS_NEW => [
            self::CUSTOMER => self::ACTION_CANCEL,
            self::EXECUTOR => self::ACTION_RESPOND,
        ],
        self::STATUS_WORKING => [
            self::CUSTOMER => self::ACTION_DONE,
            self::EXECUTOR => self::ACTION_REFUSED,
        ],
    ];

    private $idCustomer;
    private $idExecutor;

    public static $mapStatuses = [

        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCELED => 'Отменено',
        self::STATUS_WORKING => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAILED => 'Провалено'
    
    ];

    public static $mapActions = [
    
        self::ACTION_CANCEL => 'Отменить задание',
        self::ACTION_RESPOND => 'Откликнуться на задание',
        self::ACTION_DONE => 'Задание выполнено',
        self::ACTION_REFUSED => 'Отказаться от задания'
    
    ];

    public function __construct($idExecutor, $idCustomer = null) {
        
        $this->idCustomer = $idCustomer;
        $this->idExecutor = $idExecutor;
    
    }

    public static function getMapStatuses() {
    
        return $mapStatuses;
    
    }

    public static function getMapActions() {
        
        return $mapActions;

    }

    public function getStatusByAction($action) {

        return self::NEXT_STATUS[$action] ?? '';
        
    }

    public function getAllowedActions($status, $role) {

        return self::ALLOWED_ACTIONS[$status][$role] ?? '';
    }

}

?>
