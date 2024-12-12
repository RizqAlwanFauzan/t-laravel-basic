<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable   = ['nama', 'tgl_lahir', 'jekel', 'alamat'];
}
