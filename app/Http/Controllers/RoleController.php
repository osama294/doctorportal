<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        // return view('admin.subject.index', compact('subjects'));
        return view('admin.adminstrator.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try{
            $row           = new Role();
            $row->name     = $request->name;
            $row->display_name    = $request->display_name;
            $row->description = $request->description;

            $run=$row->save();

            if ($run) {
                return redirect()->route('role.index')->with('success','Role Add Sucsesfulyy...');
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $row = Role::find($id);
        return view('admin.adminstrator.role.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            $row = Role::find($id);
            $row->name=$request->name;
            $row->display_name=$request->display_name;
            $row->description=$request->description;
            // $row->status = 'Active';
            
            $run=$row->update();
    
            if ($run) {
                return redirect()->route('role.index')->with('success','Role Update Succesfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function editpermission($id)
    {
        $role = Role::where('id',$id)->with('permissions')->first();

        // return $role;

        $role_permissions = $role->permissions->pluck('id')->toArray();
     
        // return $role_permissions;

        $permissions = Permission::all();
 
        // return $permissions;

        $formattedPermissions = $this->ArrayFormateForSelect($permissions);

        // return $formattedPermissions;

        return view('admin.adminstrator.role.assign_permission',compact('formattedPermissions','permissions','role_permissions','role'));
    }

    private function ArrayFormateForSelect($permissions)
    {
        //separate name and id from permission
        $permissions = $permissions->pluck('name','id')->toArray();
        //create a new array to add formated permissions
        $formattedPermissions = [];
        foreach ($permissions as $key => $permission) {
            $exploded_permissions = explode('-',$permission);
            $suffix = array_pop($exploded_permissions);
            $prefix = implode('-',$exploded_permissions);
            if (!array_key_exists($prefix,$formattedPermissions)) {
                $formattedPermissions[$prefix] = [];
            }
            array_push($formattedPermissions[$prefix],[$suffix,$key]);
        }
        return $formattedPermissions;
    }


    public function updatepermission(Request $request, $id)
    {
       
        // dd($request->all());
        try {
            // $this->validate($request, [
            //     'permissions'  => 'required|array'
            // ]);

            $role = Role::findOrFail($id);
            $role->save() && $role->syncPermissions($request->permission);
            
            return redirect()->route('role.index')->with('success','Role updated successfully');

        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
