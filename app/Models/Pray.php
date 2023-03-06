<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pray extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','status','categorie_id'];
    protected $casts = ['id' => 'integer','status' => 'boolean','categorie_id' => 'integer'];

    public function categorie()
    {
        return $this->hasOne('App\Models\Categorie','id','categorie_id');
    }
}
