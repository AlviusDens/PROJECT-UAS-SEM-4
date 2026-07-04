<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ReadingMaterial
{
    public static function getAll()
    {
        return DB::table('reading_materials')->get();
    }

    public static function findById($id)
    {
        return DB::table('reading_materials')->where('id', $id)->first();
    }

    public static function insert($data)
    {
        return DB::table('reading_materials')->insert($data);
    }

    public static function update($id, $data)
    {
        return DB::table('reading_materials')->where('id', $id)->update($data);
    }

    public static function delete($id)
    {
        return DB::table('reading_materials')->where('id', $id)->delete();
    }

    public static function incrementDownloadCount($id)
    {
        return DB::table('reading_materials')->where('id', $id)->increment('total_download');
    }

    public static function getUniqueAuthorsByType($type)
    {
        return DB::table('reading_materials')
            ->where('type', $type)
            ->select('author', DB::raw('count(*) as total_materi'))
            ->groupBy('author')
            ->orderBy('author', 'asc')
            ->get();
    }
}
