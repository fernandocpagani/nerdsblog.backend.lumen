<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 'user_id','title','image','category', 'description',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'user_id', 'id');
    }
    protected $hidden = [
        
    ];
}
