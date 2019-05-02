<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-29 20:45
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DiscussPostContext extends Model
{
    protected $primaryKey = 'discuss_post_id';

    public function post() {
        return $this->belongsTo('App\Models\DiscussPost', 'discuss_post_id');
    }
}