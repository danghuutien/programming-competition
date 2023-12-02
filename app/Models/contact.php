<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public static function add($data) {
        $data = json_decode(json_encode(removeScriptArray($data)));
        $time = date('Y-m-d H:i:s');
        // Thêm đăng ký Email
        Contact::insert([
            'name'             => $data->name ?? '',
            'email'             => $data->email ?? '',
            'phone'             => $data->phone ?? '',
            'content'             => $data->content ?? '',
            'status'            => $data->status,
            'created_at'        => $time,
            'updated_at'        => $time
        ]);
    }
}
