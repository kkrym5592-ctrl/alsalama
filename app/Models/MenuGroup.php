<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuGroup extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name',
        'image',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'group_id');
    }
}
