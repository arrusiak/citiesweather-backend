<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'comments',
        'subject',
    ];

    public function images() {
        return $this->morphMany(Image::class, 'parentable');
    }
}
