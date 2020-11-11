<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Episodio extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = ['nome', 'temporada', 'assistido', 'numero', 'serie'];
    protected $appends = ['links'];
    protected $hidden = ['serie_id', 'created_at', 'updated_at', 'deleted_at'];
    protected $perPage = 5;

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

//    public function getSerieAttribute(): object {
//        return $this->serie()->get();
//    }

    public function setSerieAttribute($serie): void {
        $this->attributes['serie_id'] = $serie['id'];
    }
}
