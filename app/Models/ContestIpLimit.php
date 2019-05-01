<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-01 14:46
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ContestIpLimit extends Model
{
    protected $attributes = [
        'deny_ips' => '{}',
        'allow_ips' => '{}'
    ];
}