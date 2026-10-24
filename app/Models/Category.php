<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'is_active',
        'group_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

   public function products()
{
    return $this->hasMany(Product::class);
}
public function menuGroup()
{
    return $this->belongsTo(MenuGroup::class, 'group_id');
}

}