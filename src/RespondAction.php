<?php

namespace  Taskforce;

class RespondAction extends DefaultAction {

    public function getTitle() {

        return 'Откликнуться на задание';

    }

    public function getInternalName() {

        return self::ACTION_RESPOND;

    }

    public function checkRights($idCustomer, $idExcutor): bool

    {

        return $idUser === $idExecutor;

    }

};

?>
