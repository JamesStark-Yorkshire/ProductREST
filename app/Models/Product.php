<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";

    public $primaryKey = 'product_id';

    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'product_price' => 'float',
    ];

    public $fillable = [
        'product_name',
        'product_desc',
        'product_category',
        'product_price'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'product_id');
    }

    public function scopeLocale($query, $locale)
    {
        return $query
            ->when($locale, function ($query, $locale) {
                return $query->with(['productDetails' => function ($query) use ($locale) {
                    $query->where('locale', $locale);
                }]);
            });
    }
}
