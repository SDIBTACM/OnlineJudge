<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-25 19:54
 */

namespace App\Models;


use App\Models\Ex\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nickname', 'email', 'password', 'school'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * 模型属性的类型
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 模型的默认属性值
     *
     * @var array
     */
    protected $attributes = [
        'nickname' => ''
    ];

    public function loginLog($count = 50) {
        return $this->hasMany('App\Model\LoginLog');
    }

    public function group() {
        return $this->belongsToMany('App\Model\group', 'user_groups');
    }
}