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

    public function loginLog($count = 50)
    {
        return $this->hasMany('App\Models\LoginLog');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'user_groups')->withTimestamps();
    }

    public function mailReceived()
    {
        return $this->hasMany('App\Models\Mail', 'to_user_id');
    }

    public function mailSent()
    {
        return $this->hasMany('App\Models\Mail', 'from_user_id');
    }

    public function solutions()
    {
        return $this->hasMany('App\Models\Solution', 'owner_id');
    }

}