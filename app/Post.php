<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table's name
    protected $table = 'posts';
    // Key
    public $primaryKey = 'id';

    //Make relationship between posts and user id
    public function user() {
        // Jokainen postaus on liitetty tiettyyn käyttäjään
        return $this->belongsTo('App\User');
    }
    
}
