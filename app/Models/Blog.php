<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','sub_category_id','title', 'author', 'image','description', 'content'];


    public function sub_category(){
        return $this->belongsTo(SubCategory::class);
    }
   public function category(){
    return $this->belongsTo(Category::class);
   }
}
