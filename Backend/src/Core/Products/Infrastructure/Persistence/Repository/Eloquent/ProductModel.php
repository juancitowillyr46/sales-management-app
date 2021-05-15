<?php


namespace App\Core\Products\Infrastructure\Persistence\Repository\Eloquent;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;

    public $timestamps = ["created_at", "updated_at", "deleted_at"];

    protected $table = "product";

    protected $fillable = [
        'id',
        'uuid',
        'sku_code',
        'name',
        'description',
        'image',
        'price',
        'cost',
        'promotion_price',
        'measure_id',
        'category_id',
        'presentation',
        'stock',
        'featured',
        'state_id',
        'created_by'
    ];

}