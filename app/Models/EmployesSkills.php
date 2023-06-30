<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Employes;
class EmployesSkills extends Model
{
    use HasFactory;
    protected $table = 'employees_skill';
    protected $fillable = ['name','rating','employee_id'];
    protected $hidden = ['created_at',"updated_at"];

    /**
     * Get the post that owns the comment.
     */
    public function employes(): BelongsTo
    {
        return $this->belongsTo(Employes::class);
    }
}
