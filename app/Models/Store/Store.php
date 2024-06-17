<?php

namespace App\Models\Store;

use App\Models\AbstractModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $name
 */
class Store extends AbstractModel
{
    use HasFactory;


    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    protected $table = 'stores';
    protected $guarded = [];
    protected $hidden = [];
    public $translatable = [];
    public $timestamps = true;
    public $softDeleting = true;

    protected $searchables = [
        'name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
