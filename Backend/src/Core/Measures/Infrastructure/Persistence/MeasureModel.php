<?php


namespace App\Core\Measures\Infrastructure\Persistence;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeasureModel extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;

    public $timestamps = ["created_at", "updated_at", "deleted_at"];

    protected $table = "measure";

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
        'state_id',
        'created_by'
    ];
}