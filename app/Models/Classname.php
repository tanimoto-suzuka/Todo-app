<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classname extends Model
{
    use HasFactory;

    // モデルに関連づけるテーブル
    protected $table = 'classnames';

    // テーブルに関連づける主キー
    protected $primaryKey = 'id';

    // 登録・編集ができるカラムのリスト
    protected $fillable = [
        'name',
        'class_number',
        'update_user',
        'created_at',
        'updated_at',
    ];
}
