<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chant extends Model
{
    use HasFactory;
    protected $fillable = ['name','status'];
    protected $appends = ['translated_at'];
    protected $casts  = ['id' => 'integer', 'status' => 'boolean'];
    protected $dates = ['created_at','updated_at'];

    public function dates($date)
    {
        return Carbon::parse($date)->setTimezone('Europe/Istanbul') ?? null;
    }

    public function getTranslatedAtAttribute()
    {
        return $this->created_at->translatedFormat('d F Y H:i');
    }

}
