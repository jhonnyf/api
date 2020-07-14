<?php

namespace App\Http\Controllers\Interfaces;

interface Rules
{
    public function rulesStore(): void;
    public function rulesUpdate(): void;
    public function rulesDestroy(): void;
}
