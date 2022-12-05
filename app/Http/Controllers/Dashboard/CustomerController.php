<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Action;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $actions = Action::where('state', '!=', 'deleted')->get();
        $employees = User::where('state', '!=', 'deleted');
        if ($request->user()->type =='employee'){
            $employees = $employees->where('id', $request->user()->id);
        }
        $employees = $employees->get();
        return view('pages.customers', ['type' => 'customers', 'actions' => $actions, 'employees' => $employees]);
    }

    public function create(CustomerRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = Customer::create([
                'name' => $request->name,
                'created_by' => $request->user()->id,
                'employee_id' => $request->employee_id,
                'action_id' => $request->action_id,
                'address' => $request->address,
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
            $data = CustomerResource::collection(Customer::where('state', '!=', 'deleted')->whereRaw('(lower(title) like "%' . strtolower($searchValue) . '%"' . ' AND ' . 'state' . '!=' . "'deleted'")->skip($request->input('start'))->take($request->input('length'))->orderBy($orderByName, $orderDir)->get());
            $dataCount = Customer::where('state', '!=', 'deleted')->whereRaw('(lower(title) like "%' . strtolower($searchValue) . '%"' . ' AND ' . 'state' . '!=' . "'deleted'")->count();
            return array('recordsTotal' => $dataCount, 'recordsFiltered' => $dataCount, 'data' => $data);
        } else {
            //get start record
            $dataCount = Customer::where('state', '!=', 'deleted')->count();
            //get page records
            $data = CustomerResource::collection(Customer::where('state', '!=', 'deleted')->skip($request->input('start'))->take($request->input('length'))->orderBy($orderByName, $orderDir)->get());
            //return data
            return array('recordsTotal' => $dataCount, 'recordsFiltered' => $dataCount, 'data' => $data);
        }
    }

    public function delete($id)
    {
        $data = Customer::where('id', $id)->first();
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
        $data = Customer::where('id', $id)->first();
        // check for return data
        if ($data) {
            return new CustomerResource($data);
        } else {
            return $this->Message("Record error");
        }
    }

    public function update(CustomerRequest $request, $id)
    {
        $data = Customer::where('id', $id)->first();
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
