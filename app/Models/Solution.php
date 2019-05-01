<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 13:58
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    public function code() {
        return $this->hasOne('App\Models\SolutionCode');
    }

    public function fullResult() {
        return $this->hasOne('App\Models\SolutionFullResult');
    }

    public function problem() {
        return $this->belongsTo('App\Models\Problem');
    }

    public function owner() {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }
}