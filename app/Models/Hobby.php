<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];
    
    public function users()
    {
        // テーブル名、カラム名のルールに則っていれば第一引数のみでよい
        return $this->belongsToMany(User::class, 'hobby_user', 'hobby_id', 'user_id');
    }
}
