<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
    ];

    public function children()
    {
        return $this->hasMany(Department::class, 'department_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function possibleParents()
    {
        return Department::where('id', '!=', $this->id)
            ->whereNotIn('id', $this->descendantIds())
            ->get();
    }

    private function descendantIds()
    {
        $childrenIds = $this->children->pluck('id')->toArray();
        $descendantIds = [];

        foreach ($this->children as $child) {
            $descendantIds = array_merge($descendantIds, $child->descendantIds());
        }

        return array_unique(array_merge($childrenIds, $descendantIds));
    }
}
