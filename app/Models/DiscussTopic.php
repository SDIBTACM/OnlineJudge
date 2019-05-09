<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-29 20:44
 */

namespace App\Models;


use App\Models\Ex\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DiscussTopic extends Model
{
    use SoftDeletes;

    public function posts()
    {
        return $this->hasMany('App\Models\DiscussPost', 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }
}