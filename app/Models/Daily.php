<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Daily extends Model
{
    use HasFactory;
    protected $fillable = ['pray_id', 'date', 'status'];
    protected $dates = ['created_at', 'updated_at', 'date'];
    protected $casts = ['id' => 'integer', 'pray_id' => 'integer', 'status' => 'boolean'];
    protected $appends = ['translated_at'];

    public function pray()
    {
        return $this->hasOne('App\Models\Pray', 'id', 'pray_id');
    }

    public function dates($date)
    {
        return Carbon::parse($date)->setTimezone('Europe/Istanbul') ?? null;
    }

    public function getTranslatedAtAttribute()
    {
      $date = Carbon::parse($this->date);
      $date = $date->translatedFormat('d F Y');
      return $date;
    }
}
