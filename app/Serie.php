<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = ['nome'];
    protected $appends = ['links'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $perPage = 5;


    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function getLinksAttribute(): array {
        return [
            'self' => "/api/series/{$this->id}",
            'episodios' => "/api/series/{$this->id}/episodios"
        ];
    }
}
