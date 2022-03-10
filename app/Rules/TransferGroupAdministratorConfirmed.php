<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TransferGroupAdministratorConfirmed implements Rule
{
    public $newAdminUserId;

    public $initialAdminUserId;

    public function __construct($newAdminUserId, $initialAdminUserId)
    {
        $this->newAdminUserId = $newAdminUserId;
        $this->initialAdminUserId = $initialAdminUserId;
    }

    public function passes($attribute, $value)
    {
        if ((int)$this->newAdminUserId === (int)$this->initialAdminUserId) {
            return true;
        }

        return (bool)$value;
    }

    public function message()
    {
        return 'You must confirm group administrator transfer.';
    }
}
