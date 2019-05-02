<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 13:17
 */

namespace App\Models;


use App\Models\Ex\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use SoftDeletes;

    public function description() {
        return $this->hasOne('App\Models\ProblemDescription');
    }

    public function extraCode() {
        return $this->hasOne('App\Models\ProblemExtraCode');
    }

    public function solution() {
        return $this->hasMany('App\Models\Solution');
    }

    public function owner() {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }
}