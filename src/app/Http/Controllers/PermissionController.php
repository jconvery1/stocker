<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return Permission::all();
    }

    public function supplierDropdown()
    {
        return Permission::all();
    }

    public function store(Request $permissions)
    {
        $permissions = $permissions->all();
        foreach ($permissions as $permission) {
            $record = Permission::find($permission['id']);
            $record->access = $permission['access'];
            $record->save();
        }
    }
}
