<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-27 15:03
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    /**
     * 模型的默认属性值
     *
     * @var array
     */
    protected $attributes = [
        'value' => '{}',
        'comment' => ''
    ];
}