<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 14:32
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    public function ipLimits() {
        return $this->hasOne('App\Models\ContestIpLimit');
    }

    public function register() {
        return $this->hasMany('App\Models\ContestRegister');
    }

    public function privileges() {
        return $this->hasMany('App\Models\ContestPrivileges');
    }

    public function problem() {
        return $this->hasMany('App\Models\ContestProblem')->orderBy('problem_order');
    }

    public function result() {
        return $this->hasMany('App\Models\ContestResult');
    }
}