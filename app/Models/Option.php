<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-27 15:03
 */

namespace App\Models;


use App\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

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

    /**
     * get options, if not in cache it will be cached
     * @param string $key
     * @return mixed
     */
    static public function getOption($key)
    {
        if (config('debug') && Cache::has('option:' . $key)) {
            return Cache::get('option:' . $key);
        }

        $option = self::where('key', $key)->first();
        if (is_null($option)) {
            return '';
        }

        try {
            Cache::set('option:' . $key, $option->value, 10 * 60);
        } catch (InvalidArgumentException $e) {
            Log::error('Cache Failed! err: {}', $e->getMessage());
        }

        return $option->value;
    }

    /**
     * set option, if in cache it will be update,
     * if not exists, will have error.
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    static public function setOption($key, $value)
    {
        $option = self::where('key', $key)->first();
        if (is_null($option)) {
            return false;
        }
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }

        $option->value = $value;
        $option->save();

        if (Cache::has('option:' . $key)) {
            Cache::forget('option:' . $key);
        }

        return true;

    }

    /**
     * get comment.
     * @param string $key
     * @return mixed
     */
    static public function getComment($key)
    {
        $option = self::where('key', $key)->first();
        if (is_null($option)) {
            return '';
        }
        return $option->value;
    }

    /**
     * set comment.
     * @param string $key
     * @param string $comment
     * @return bool
     */
    static public function setComment($key, $comment)
    {
        $option = self::where('key', $key)->first();
        if (is_null($option)) {
            return false;
        }

        $option->comment = $comment;
        $option->save();

        return true;
    }
}