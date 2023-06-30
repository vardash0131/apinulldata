<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\EmployesSkills;
class Employes extends Model
{
    use HasFactory;
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','position','birth_date','address'];
    protected $hidden = ['created_at',"updated_at"];

    /**
     * Get the comments for the blog post.
     */
    public function skills(): HasMany
    {
        return $this->hasMany(EmployesSkills::class);
    }
}
