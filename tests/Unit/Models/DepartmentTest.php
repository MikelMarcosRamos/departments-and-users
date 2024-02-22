<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_parent_department_nulls_children_department_id(): void
    {
        $department1 = Department::factory()->create();
        $department2 = Department::factory()->create([
            'department_id' => $department1->id
        ]);

        $department1->delete();
        $department2->refresh();

        $this->assertNull($department2->department_id);
    }

    public function test_get_possible_parents(): void
    {
        $department1 = Department::factory()->create();
        $department2 = Department::factory()->create([
            'department_id' => $department1->id
        ]);
        $department3= Department::factory()->create([
            'department_id' => $department2->id
        ]);
        $department4= Department::factory()->create([
            'department_id' => $department3->id
        ]);

        $this->assertEquals(3, $department4->possibleParents()->count());
        $this->assertEquals(2, $department3->possibleParents()->count());
        $this->assertEquals(1, $department2->possibleParents()->count());
        $this->assertEquals(0, $department1->possibleParents()->count());
    }
}
