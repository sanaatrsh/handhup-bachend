<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
public function user(){

return $this->belongsTo(User::class);

}

//public function reports(){

  //  return $this->hasMany(report::class,'report_id');
//}

public function review(){

    return $this->hasMany(review::class,'review_id','id');
}

public function product(){

    return $this->hasMany(product::class,'product_id','id');
}
public function users()
{
    $this->belongsTo(User::class, 'user_id', 'id');
}

public function category()
{
    $this->belongsTo(category::class,'category_id', 'id');
}
}
