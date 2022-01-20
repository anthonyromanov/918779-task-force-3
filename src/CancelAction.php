<?php

namespace  Taskforce;

class CancelAction extends DefaultAction {

    public function getTitle() {

        return 'Отменить задание';

    }

    public function getInternalName() {

        return self::ACTION_CANCEL;

    }

    public function checkRights($idCustomer, $idExecutor): bool

    {

        return $idUser === $idCustomer;

    }

};

?>
