<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\Rules;
use App\User as Module;

class UsersController extends Controller implements Rules
{
    public function __construct()
    {
        $this->Module = Module::class;

        $this->rulesStore();
        $this->rulesUpdate();
        $this->rulesDestroy();
    }

    public function rulesStore(): void
    {
        $rules_store['user_type_id']     = 'required|integer|exists:users_types,id';
        $rules_store['email']            = 'required|string|unique:users|max:255|email:rfc,dns';
        $rules_store['first_name']       = 'required|string|max:255';
        $rules_store['last_name']        = 'required|string|max:255';
        $rules_store['password']         = 'required|max:255';
        $rules_store['document']         = 'required|unique:users|max:16';
        $rules_store['terms_conditions'] = 'required|boolean';

        $this->setRulesStore($rules_store);
    }

    public function rulesUpdate(): void
    {
        $rules_update['id']    = 'required|integer|exists:users';
        $rules_update['email'] = 'required|string|unique:users,email,__REPLACE_ID__,id|max:255';

        $this->setRulesUpdate($rules_update);
    }

    public function rulesDestroy(): void
    {
        $this->setRulesDestroy(['id' => 'required|integer|exists:users']);
    }
}
