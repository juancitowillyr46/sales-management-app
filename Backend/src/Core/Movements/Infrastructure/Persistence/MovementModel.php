<?php


namespace App\Core\Movements\Infrastructure\Persistence;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovementModel extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;

    public $timestamps = ["created_at", "updated_at", "deleted_at"];

    protected $table = "product_movement";

    protected $fillable = [
        'id',
        'uuid',
        'document_type_id',
        'document_num',
        'date_issue',
        'movement_type',
        'concept',
        'total_price',
        'state_id',
        'created_by'
    ];
}