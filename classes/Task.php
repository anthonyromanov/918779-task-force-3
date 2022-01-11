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

    const EXECUTOR = 'executor';
    const CUSTOMER = 'customer';

    private $idCustomer;
    private $idExecutor;

    public $currentStatus;
    public $currentAction;

    public static $mapStatuses =
    
    [
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

    public function getStatus() {

        return $this->currentStatus;
    
    }

    public function getAvailableActions($role) {

        if ($role === CUSTOMER) {

            if ($this->currentStatus === STATUS_NEW) {
            
                return self::ACTION_CANCEL;
            
            }
            
            if ($this->currentStatus === STATUS_WORKING) {
            
                return self::ACTION_DONE;
            
            }
            
            return null;
        }

        if ($role === EXECUTOR) {
        
            if ($this->currentStatus === STATUS_NEW) {
        
                return self::ACTION_RESPOND;
            
            }
        
            if ($this->currentStatus === STATUS_WORKING) {
        
                return self::ACTION_REFUSED;
     
            }
     
            return null;
     
        }
    
    }

}

?>
