<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Premium $premiums
 * @property Token $tokens
 */
class Category extends Model
{
    protected $fillable = ['category'];

    public $timestamps = false;

    public function premiums()
    {
        return $this->hasMany(Premium::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}
