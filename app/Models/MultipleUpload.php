<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleUpload extends Model
{
    protected $table = 'multiple_uploads';

    protected $fillable = [
        'pelanggan_id',
        'filename',
        'original_name',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }
}
