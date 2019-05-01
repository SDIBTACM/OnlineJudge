<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 14:47
 */

namespace App\Models;


use App\Models\Ex\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ContestRegister extends Model
{
    use SoftDeletes;

    public function contest() {
        return $this->belongsTo('App\Models\Contest');
    }

    public function user() {
        return $this->hasOne('App\Models\User');
    }
}