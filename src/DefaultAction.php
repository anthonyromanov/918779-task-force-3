<?php

namespace  Taskforce;

abstract class DefaultAction {

    const ACTION_CANCEL = 'cancel';
    const ACTION_RESPOND = 'respond';
    const ACTION_DONE = 'done';
    const ACTION_REFUSED = 'refused';

    private $idUser;

    private function setIdCustomer ($idUser) {

        $this->idCustomer = $idUser;

    }

    private function setIdExecutor ($idUser) {

        $this->idExecutor = $idUser;

    }

    public function __construct($idExecutor, $idCustomer = null) {

        $this->setIdCustomer($idCustomer);
        $this->setIdExecutor($idExecutor);

    }

    abstract public function getTitle();

    abstract public function getInternalName();

    abstract public function checkRights($idExecutor, $idCustomer);

};

?>
