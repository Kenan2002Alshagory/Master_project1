<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'photo',
        'category_id'
    ];

    /**
     * Get the reviews for the food.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

     /**
     * Get the category that owns the food.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsToMany(User::class,'reviews') ->withPivot('rate');
    }
}
