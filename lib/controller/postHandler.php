<?php

class postHandler
{
    /**
     * postHandler constructor.
     */
    public function __construct()
    {
    }

    public function run()
    {
        if (!isset($_POST["action"])){
            return;
        }

        if ($_POST["action"] == "addUser")
        {
            $user = new addressBook();
            $columnNames->columnNames();
            foreach (array_slice($columnNames, 0) as $key => $value) 
            {
                $user->setValue($key, $value);
             //   $user->set.$value.($_POST["$value"]);
            }
            $user->add();
        }

        elseif ($_POST["action"] == "editUser")
        {
            $user = new addressBook();
            foreach($user->columnNames() as $column)
            {
                $user->setValue($column, $_POST[$column]);
            }
        }
    }
}