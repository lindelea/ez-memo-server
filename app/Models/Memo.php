<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * 検索用フィルター
     * @param $query
     * @param $keyword
     */
    public function scopeFilter($query, $keyword)
    {
        if ($keyword) {
            $query->where('title', 'LIKE', '%'.$keyword.'%');
            $query->orWhere('contents', 'LIKE', '%'.$keyword.'%');
        }
    }
}
