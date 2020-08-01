<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episodio extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = ['nome', 'temporada', 'assistido', 'numero', 'serie_id'];

    public function serie() {
        return $this->belongsTo(Serie::class);
    }
}
