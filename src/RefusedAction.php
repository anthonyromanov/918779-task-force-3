<?php

namespace  Taskforce;

class RefusedAction extends DefaultAction {

    public function getTitle() {

        return 'Отказаться от задания';

    }

    public function getInternalName() {

        return self::ACTION_REFUSED;

    }

    public function checkRights($idCustomer, $idExcutor): bool

    {

        return $idUser === $idExecutor;

    }

}

?>
