<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    //
    protected $fillable = [
                    'title', 'description', 'image', 'on_sale',
                    'rating', 'sold_count', 'review_count', 'price'
    ];

    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];
    // 与商品SKU一对多关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    // 转换 images 字段的 url 为绝对路径
    public function getImageUrlAttribute()
    {
        // 如果 images 字段本身就是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'],['http://', 'https://'])) {
            return $this->attributes['image'];
        }

        // \Storage::disk('public') 的参数 public 需要和 config/admin.php 里面的 upload.disk 配置一致。
        return \Storage::disk('public')->url($this->attributes['image']);
    }
}
