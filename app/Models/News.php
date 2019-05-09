<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 13:07
 */

namespace App\Models;


use App\Models\Ex\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use SoftDeletes;

    public function context()
    {
        return $this->hasOne('App\Models\NewsContext');
    }
}