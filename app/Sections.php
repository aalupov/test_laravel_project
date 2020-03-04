<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sections extends Model
{
    use SoftDeletes;

    /**
     * Get the users for the section.
     */
    public function users_section()
    {
        return $this->hasMany(UsersSectionsRelationships::class, 'section_id');
    }
}
