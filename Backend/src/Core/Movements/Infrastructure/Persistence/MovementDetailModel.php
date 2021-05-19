<?php


namespace App\Core\Movements\Infrastructure\Persistence;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovementDetailModel extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;

    public $timestamps = ["created_at", "updated_at", "deleted_at"];

    protected $table = "movement_detail";

    protected $fillable = [
        'id',
        'uuid',
        'movement_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'state_id',
        'created_by'
    ];
}