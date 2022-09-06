<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department=new Department();
        $department->name='Accounts';
        $department->desc='Accounts';
        $department->save();

        $department=new Department();
        $department->name='Hr';
        $department->desc='Human Resource';
        $department->save();

        $department=new Department();
        $department->name='supporting';
        $department->desc='Supporting';
        $department->save();

    }
}
