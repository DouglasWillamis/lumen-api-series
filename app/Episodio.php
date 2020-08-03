<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episodio extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = ['nome', 'temporada', 'assistido', 'numero', 'serie_id'];
    protected $appends = ['links', 'serie'];
    protected $hidden = ['serie_id'];

    public function serie() {
        return $this->belongsTo(Serie::class);
    }

    public function getAssistidoAttribute($assistido): bool
    {
        return $assistido;
    }

    public function getLinksAttribute(): array {
        return [
            'self' => "/api/episodios/{$this->id}",
            'serie' => "/api/series/{$this->serie_id}"
        ];
    }

    public function getSerieAttribute(): object {
        return $this->serie()->get();
    }
}
