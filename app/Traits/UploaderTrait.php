<?php
namespace App\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

trait UploaderTrait
{
    /**
     * getDisk
     *
     * @return string
     */
    public static function getDisk()
    {
        $environment = App::environment();
        return match ($environment) {
            'local' => 'local',
            default => 'local',
        };
    }

    /**
     * storeFile
     *
     * @param  mixed  $file
     * @param  string  $path
     * @return string|false
     */
    public static function storeFile($file, $path)
    {
        $disk = self::getDisk();
        return $file->store($path, $disk);
    }
}
