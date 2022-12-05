<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.users', ['type' => 'users']);
    }

    public function create(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'type' => $request->type,
            ]);
            // commit data
            DB::commit();
            // retrun reponse if created and error if not
            if ($data) {
                return $this->Message("Record Inserted", $data->id, ['hideForm()', 'UpdateTable()']);
            } else {
                return $this->Message("Error while Record Inserted", $data->id, ['UpdateTable()', 'hideForm()']);
            }
        } catch (\Throwable $th) {
            return $th;
            DB::rollback();
            return $this->Message("Error while Record Inserted", 0, ['UpdateTable()', 'hideForm()']);
        }
    }

    public function records(Request $request)
    {
        $columns = $request->input('columns');
        $orderBy = $request->input('order')[0]['column'];
        $orderByName = $columns[$orderBy]['name'];
        $orderDir = $request->input('order')[0]['dir'];
        $searchValue = $request->input('search')['value'];

        if ($searchValue != null) {
            $data = UserResource::collection(User::where('state', '!=', 'deleted')->whereRaw('(lower(title) like "%' . strtolower($searchValue) . '%"' . ' AND ' . 'state' . '!=' . "'deleted'")->skip($request->input('start'))->take($request->input('length'))->orderBy($orderByName, $orderDir)->get());
            $dataCount = User::where('state', '!=', 'deleted')->whereRaw('(lower(title) like "%' . strtolower($searchValue) . '%"' . ' AND ' . 'state' . '!=' . "'deleted'")->count();
            return array('recordsTotal' => $dataCount, 'recordsFiltered' => $dataCount, 'data' => $data);
        } else {
            //get start record
            $dataCount = User::where('state', '!=', 'deleted')->count();
            //get page records
            $data = UserResource::collection(User::where('state', '!=', 'deleted')->skip($request->input('start'))->take($request->input('length'))->orderBy($orderByName, $orderDir)->get());
            //return data
            return array('recordsTotal' => $dataCount, 'recordsFiltered' => $dataCount, 'data' => $data);
        }
    }

    public function delete($id)
    {
        $data = User::where('id', $id)->first();
        if ($data) {
            DB::beginTransaction();
            try {
                $data->update([
                    'state' => 'deleted',
                ]);
                DB::commit();
                return $this->Message("Record Deleted", $data, ['hideForm()', 'UpdateTable()']);
            } catch (\Throwable $th) {
                DB::rollback();
                return $this->Message("Error while Record Deleted", $data, ['UpdateTable()', 'hideForm()']);
            }
        } else {
            return $this->Message("Record not found", $data, ['UpdateTable()', 'hideForm()']);
        }
    }

    public function record($id)
    {
        //get record data
        $data = User::where('id', $id)->first();
        // check for return data
        if ($data) {
            return new UserResource($data);
        } else {
            return $this->Message("Record error");
        }
    }

    public function update(Request $request, $id)
    {
        $data = User::where('id', $id)->first();
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$data->id,
        ];
        if ($request->exists('password')) {
            $rules['password'] = 'required|string|confirmed|min:8';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->Message("Error while Record Inserted", $id, ['UpdateTable()', 'hideForm()']);
        }

        if ($data) {
            DB::beginTransaction();
            try {
                $data->update($request->all());
                // return $data;
                DB::commit();
                return $this->Message("Record Inserted", $data->id, ['hideForm()', 'UpdateTable()']);
            } catch (\Throwable $th) {
                DB::rollback();
                return $this->Message("Error while Record Inserted", $data->id, ['UpdateTable()', 'hideForm()']);
            }
        } else {
            return $this->Message("Error while Record Inserted", $data->id, ['UpdateTable()', 'hideForm()']);
        }
    
}
}
