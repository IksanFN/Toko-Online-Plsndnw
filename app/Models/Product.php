<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_category_id',
        'thumbnail',
        'name',
        'slug',
        'sku',
        'price',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function productStocks(): HasMany
    {
        return $this->hasMany(ProductStock::class);
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            return $query->whereAny(['name', 'sku'], 'like', '%' . $search . '%');
        });
    }

    public static function generateSKU($category)
    {
        // Get Code Category
        $prefixCategory = ProductCategory::query()->where('id', $category)->first();

        // Check the last product
        $lastProduct = self::query()->where('product_category_id', $category)->latest()->first();

        // Check the last sku number
        $lastNumber = $lastProduct ? (int) substr($lastProduct->sku, -4) : 0;

        // Generate new number
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);

        // Generate SKU
        $newSKU = "SKU$prefixCategory->code$newNumber";
        return $newSKU;
    }

    public static function updateSKU($idProductCategory)
    {
        $newCategory = ProductCategory::query()->find($idProductCategory);
        $lastProductInNewCategory = Product::query()->where('product_category_id', $newCategory->id)->latest()->first();
        $lastNumber = $lastProductInNewCategory ? (int) substr($lastProductInNewCategory->sku, -4) : 0;

        // Generate SKU baru
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        $newSKU = "SKU$newCategory->code$newNumber";

        return $newSKU;
    }

}
