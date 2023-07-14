<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WarehouseDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = "warehouse_detail";
    public $incrementing = false;
}