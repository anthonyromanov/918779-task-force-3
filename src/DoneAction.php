<?php

namespace  Taskforce;

class DoneAction extends DefaultAction {

    public const ACTION_DONE = 'done';

    public function getTitle() {

        return 'Выполнено';

    }

    public function getInternalName() {

        return self::ACTION_DONE;

    }

    public function checkRights($idExecutor, $idCustomer)

    {

        return $this->idUser === $this->idCustomer;

    }

};

?>
