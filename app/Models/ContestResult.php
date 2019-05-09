<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 15:42
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ContestResult extends Model
{
    public function contest()
    {
        return $this->belongsTo('App\Models\Contest');
    }

    public function problem()
    {
        return $this->hasOne('App\Models\ContestProblem');
    }
}