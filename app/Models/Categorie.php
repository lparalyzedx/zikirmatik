<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];
    protected $casts = ['id' => 'integer', 'status' => 'boolean'];
    protected $appends = ['pray_count', 'translated_at'];
    protected $dates = ['created_at', 'updated_at'];

    public function pray()
    {
        return $this->hasMany('App\Models\Pray', 'categorie_id', 'id')->where('status',true);
    }

    public function getPrayCountAttribute()
    {
        return $this->pray()->where('status',true)->count();
    }

    public function dates($date)
    {
        return Carbon::parse($date)->setTimezone('Europe/Istanbul') ?? null;
    }

    public function getTranslatedAtAttribute()
    {
        return $this->created_at->translatedFormat('d F Y H:i');
    }
}
