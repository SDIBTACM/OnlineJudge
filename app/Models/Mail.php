<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-29 20:35
 */

namespace App\Models;


use App\Models\Ex\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use SoftDeletes;

    public function context() {
        return $this->hasOne('App\Models\MailContext');
    }

}