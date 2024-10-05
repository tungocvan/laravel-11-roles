<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Models\WpTermTaxonomy;

class WpTerm extends Model
{
    use HasFactory;
    // protected $connection = 'wordpress';
    // protected $table = 'wp_users';
    // protected $primaryKey = 'ID';
    // protected $fillable = [];
    // protected $hidden = [];
    // public $timestamps = true;
    // const CREATED_AT ="created_at";
    // const UPDATED_AT ="updated_at";
    protected $table = 'wp_terms';
    protected $primaryKey = 'term_id';
    protected $fillable = ['name', 'slug', 'term_group'];
    public function termTaxonomy()
    {
        return $this->hasOne(WpTermTaxonomy::class, 'term_id', 'term_id');
    }

}
