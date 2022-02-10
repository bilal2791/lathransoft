<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
     // all Employees
     public function index()
     {
         $employees = Employee::all()->toArray();
         return array_reverse($employees);
     }
 
     // add Employee
     public function add(Request $request)
     {
         $employee = new Employee([
             'name' => $request->name,
             'email' => $request->email,
             'phone' => $request->phone,
             'address' => $request->address,
             'designation' => $request->designation,
             'department' => $request->department,
             'about' => $request->about
              
         ]);
         $employee->save();
 
         return response()->json('The Employee successfully added');
     }
 
     // edit Employee
     public function edit($id)
     {
         $Employee = Employee::find($id);
         return response()->json($Employee);
     }
 
     // update employee
     public function update($id, Request $request)
     {
         $employee = Employee::find($id);
         $employee->update($request->all());
 
         return response()->json('The Employee successfully updated');
     }
 
     // delete Employee
     public function delete($id)
     {
         $employee = Employee::find($id);
         $employee->delete();
 
         return response()->json('The employee successfully deleted');
         
     }
 
}
