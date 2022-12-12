<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgram extends Model
{
    use HasFactory;

    protected $fillable = ['program_builder_id', 'user_id','assigned_by'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function program(){
        return $this->hasOne('\App\Models\ProgramBUilder','id','program_builder_id');
    }
}
