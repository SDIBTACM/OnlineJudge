<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 14:50
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ContestPrivilege extends Model
{
    public function contest()
    {
        return $this->belongsTo('App\Models\Contest');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}