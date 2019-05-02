<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 15:19
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ContestProblem extends Model
{
    public function contest() {
        return $this->belongsTo('App\Models\Contest');
    }

    public function result() {
        return $this->hasMany('App\Models\ContestResult', 'contest_problem_id');
    }

    public function problem() {
        return $this->belongsTo('App\Models\Problem');
    }
}