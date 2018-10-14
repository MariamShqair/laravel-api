<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;
class Lesson extends Model
{
    protected $fillable =['title','body','some_bool'];

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }
}
