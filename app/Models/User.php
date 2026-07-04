<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class User
{
    public static function attemptLogin($loginInput, $password)
    {
        return DB::table('users')
            ->where(function ($query) use ($loginInput) {
                $query->where('email', $loginInput)
                    ->orWhere('nim', $loginInput);
            })
            ->where('password', $password)
            ->first();
    }

    public static function findById($id)
    {
        return DB::table('users')->where('id', $id)->first();
    }

    public static function insertUser($data)
    {
        return DB::table('users')->insert($data);
    }

    public static function updateUser($id, $data)
    {
        return DB::table('users')->where('id', $id)->update($data);
    }

    public static function getUsersByRole($role)
    {
        return DB::table('users')->where('role', $role)->get();
    }

    public static function countAll()
    {
        return DB::table('users')->count();
    }

    public static function deleteUser($id)
    {
        return DB::table('users')->where('id', $id)->delete();
    }
}