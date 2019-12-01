<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-27 15:12
 */

namespace App\Models\Ex;

use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletesSource;

trait SoftDeletes
{
    use SoftDeletesSource;

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new SoftDeletingScope);
    }

    /**
     * Restore a soft-deleted model instance.
     *
     * @return bool|null
     */
    public function restore()
    {
        // If the restoring event does not return false, we will proceed with this
        // restore operation. Otherwise, we bail out so the developer will stop
        // the restore totally. We will clear the deleted timestamp and save.
        if ($this->fireModelEvent('restoring') === false) {
            return false;
        }

        $this->{$this->getDeletedAtColumn()} = 1;

        // Once we have saved the model, we will fire the "restored" event so this
        // developer will do anything they need to after a restore operation is
        // totally finished. Then we will return the result of the save call.
        $this->exists = true;

//        $SQL_MODE = \DB::select("select @@sql_mode sql_mode")[0]->sql_mode;
//        \DB::statement("set @@sql_mode = ''");
        $result = $this->save();
//        \DB::update('set @@sql_mode = ?', ["$SQL_MODE"]);

        $this->fireModelEvent('restored', false);

        return $result;
    }

    /**
     * Determine if the model instance has been soft-deleted.
     *
     * @return bool
     */
    public function trashed()
    {
        return !($this->{$this->getDeletedAtColumn()} === 0);
    }

}
