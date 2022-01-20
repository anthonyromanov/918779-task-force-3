<?php

namespace  Taskforce;

class DoneAction extends DefaultAction {

    public function getTitle() {

        return 'Выполнено';

    }

    public function getInternalName() {

        return self::ACTION_DONE;

    }

    public function checkRights($idCustomer, $idExcutor): bool

    {

        return $idUser === $idCustomer;

    }

};

?>
