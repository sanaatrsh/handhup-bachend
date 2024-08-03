<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ProductImages()
    {
        $this->hasMany(ProductImage::class);
    }
    public function project()
{
    $this->belongsTo(Project::class, 'project_id', 'id');
}
public function category()
{
    $this->belongsTo(category::class, 'category_id', 'id');
}
}
