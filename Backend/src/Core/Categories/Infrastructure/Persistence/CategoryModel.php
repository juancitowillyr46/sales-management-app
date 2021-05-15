<?php


namespace App\Core\Categories\Infrastructure\Persistence;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;

    public $timestamps = ["created_at", "updated_at", "deleted_at"];

    protected $table = "category";

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
        'image',
        'state_id',
        'created_by'
    ];
}