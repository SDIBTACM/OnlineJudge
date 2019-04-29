<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-29 20:45
 */

namespace App\Models;


use App\Models\Ex\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DiscussPost extends Model
{
    use SoftDeletes;

    public function topic() {
        return $this->belongsTo('App\Models\DiscussTopic', 'topic_id');
    }

    public function context() {
        return $this->hasOne('App\Models\DiscussPostContext', 'discuss_post_id');
    }
}