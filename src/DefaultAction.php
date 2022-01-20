<?php

namespace  Taskforce;

abstract class DefaultAction {

    private $idUser;

    private function setIdCustomer ($idUser, $idCustomer) {

        $this->idCustomer = $idUser;

    }

    private function setIdExecutor ($idUser, $idExecutor) {

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
