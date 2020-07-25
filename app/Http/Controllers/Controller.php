<?php

namespace App\Http\Controllers;

use App\Services\DbMetaData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected $Module;

    private $rules_store;
    private $rules_update;
    private $rules_destroy;

    public function index()
    {
        $result = $this->Module::where('active', '<>', 2)
            ->orderBy('id', 'DESC')
            ->get();

        return $this->buildReturn(false, $result);
    }

    public function show(int $id)
    {
        $result = $this->Module::where('active', '<>', 2)
            ->find($id);

        return $this->buildReturn(false, $result);
    }

    public function store(Request $request)
    {
        $error   = true;
        $message = null;
        $result  = array();

        $validator = Validator::make($request->all(), $this->rules_store);

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $error  = false;
            $result = $this->Module::create($request->all());
        }

        return $this->buildReturn($error, $result, $message);
    }

    public function update(int $id, Request $request)
    {
        $error   = true;
        $message = null;
        $result  = array();

        array_walk($this->rules_update, function ($rule, $key, $id) {
            $this->rules_update[$key] = str_replace('__REPLACE_ID__', $id, $rule);
        }, $id);

        $validator = Validator::make(array_merge(['id' => $id], $request->all()), $this->rules_update);

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $error  = false;
            $result = $this->Module::find($id)->fill($request->all())->save();
        }

        return $this->buildReturn($error, $result, $message);
    }

    public function destroy(int $id, Request $request)
    {
        $error   = true;
        $message = null;
        $result  = array();

        $validator = Validator::make(array_merge(['id' => $id], $request->all()), $this->rules_destroy);

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $error = false;
            $obj   = $this->Module::find($id);

            $obj->active = 2;

            $obj->save();
        }

        return $this->buildReturn($error, $result, $message);
    }

    public function tableFields()
    {
        $Model = new $this->Module;

        $fields = DB::select('DESCRIBE ' . $Model->getTable());

        $return = DbMetaData::fields($fields);

        return $this->buildReturn(false, $return);
    }

    /**
     * PRIVATE
     */

    private function buildReturn(bool $error, $result, $message = null)
    {
        $message = !is_null($message) ? $message : ($error ? 'Não foi possivel realizar a ação!' : 'Ação realizada com sucessso!');

        $response = ['error' => $error, 'result' => $result, 'message' => $message];

        return response()->json($response);
    }

    /**
     * SETS
     */

    public function setRulesStore(array $rules_store): void
    {
        $this->rules_store = $rules_store;
    }

    public function setRulesUpdate(array $rules_update): void
    {
        $this->rules_update = $rules_update;
    }

    public function setRulesDestroy(array $rules_destroy): void
    {
        $this->rules_destroy = $rules_destroy;
    }
}
