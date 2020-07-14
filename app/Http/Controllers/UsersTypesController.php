<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\Rules;
use App\Model\UsersTypes as Module;

class UsersTypesController extends Controller implements Rules
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
        $rules_store['user_type'] = 'required|string|unique:users_types,user_type|max:255';

        $this->setRulesStore($rules_store);
    }

    public function rulesUpdate(): void
    {
        $rules_update['id']        = 'required|integer|exists:users_types';
        $rules_update['user_type'] = 'required|string|unique:users_types,user_type,__REPLACE_ID__,id|max:255';

        $this->setRulesUpdate($rules_update);
    }

    public function rulesDestroy(): void
    {
        $this->setRulesDestroy(['id' => 'required|integer|exists:users_types']);
    }
}
