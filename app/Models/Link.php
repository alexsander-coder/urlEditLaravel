<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_link',
        'short_link',
        'clicks',
        'nome_ficticio'
    ];

    public function linkAccesses() {
        return $this->hasMany(LinkAccess::class, 'link_id', 'id');
    }
}