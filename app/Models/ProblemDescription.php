<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 13:18
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProblemDescription extends Model
{
    protected $primaryKey = 'problem_id';

    public function problem()
    {
        return $this->belongsTo('App\Models\Problem');
    }
}