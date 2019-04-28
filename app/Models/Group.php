<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-27 17:29
 */

namespace App\Models\Ex;


use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use SoftDeletes;

    public function user() {
        return $this->belongsToMany('App/Model/User', 'user_groups');
    }
}