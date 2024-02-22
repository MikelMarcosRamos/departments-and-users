<?php

namespace App\Observers;

use App\Models\Department;

class DepartmentObserver
{
    public function deleting(Department $department)
    {
        $department->children()->update(['department_id' => null]);
    }
}
