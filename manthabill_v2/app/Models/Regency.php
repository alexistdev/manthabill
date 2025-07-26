<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regency extends Model
{
    use SoftDeletes,HasUuids;

    protected $primaryKey = 'id';
    protected $table = 'regencies';
    protected $fillable = ['province_id','name'];


    public function province(){
        return $this->belongsTo(Province::class);
    }
}
