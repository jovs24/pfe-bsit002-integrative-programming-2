<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'department',
        'department_id',
        'position',
    ];

    /**
     * Week 5 - an employee belongs to one department.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
