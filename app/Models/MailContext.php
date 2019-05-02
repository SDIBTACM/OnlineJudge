<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-29 20:35
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MailContext extends Model
{
    protected $primaryKey = 'mail_id';

    public function mail() {
        return $this->belongsTo('App\Models\Mail');
    }
}