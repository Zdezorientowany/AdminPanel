<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'content',
        'publish_date',
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
