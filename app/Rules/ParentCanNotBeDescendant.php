<?php

namespace App\Rules;

use Closure;
use App\Models\Department;
use Illuminate\Contracts\Validation\ValidationRule;

class ParentCanNotBeDescendant implements ValidationRule
{
    private Department $currentDepartment;

    public function __construct(Department $currentDepartment)
    {
        $this->currentDepartment = $currentDepartment;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $department = Department::findOrFail($value);
        $possibleParents = $this->currentDepartment->possibleParents();

        if (!$possibleParents->contains('id', $department->id)) {
            $fail("The parent can not be a descendant.");
        }
    }
}
