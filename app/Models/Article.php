<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function GuzzleHttp\json_decode;

class article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function getTitleAttribute($value)
    {
        // request()->header('lang') ? $lang=request()->header('lang'): $lang="en";
       $title = json_decode($value,true);  
        return $title[app()->getLocale()];

    }
    public function getContentAttribute($value)
    {
    //   dd();
    //     request()->header('lang') ? $lang=request()->header('lang'): $lang="en";
           $content = json_decode($value,true);  
        return $content[app()->getLocale()];

    }
   
    

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
       
    ];
}
