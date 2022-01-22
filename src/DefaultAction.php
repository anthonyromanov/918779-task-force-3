<?php

namespace  Taskforce;

abstract class DefaultAction {

    private $idUser;

    public function __construct($idExecutor, $idCustomer = null) {

        $this->idExecutor = $idExecuror;
        $this->idCustomer = $idCustomer;

    }

    abstract public function getTitle();

    abstract public function getInternalName();

    abstract public function checkRights($idExecutor, $idCustomer);

};

?>
