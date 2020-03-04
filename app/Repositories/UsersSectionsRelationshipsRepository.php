<?php
namespace App\Repositories;

use App\UsersSectionsRelationships as Model;

/**
 * Class UsersSectionsRelationshipsRepository
 *
 * @package App\Repositories
 */
class UsersSectionsRelationshipsRepository extends CoreRepository
{

    /**
     *
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get Model to edit
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Add the users-section relatioship
     *
     * @param int $section_id
     * @param int $user_id
     *
     * @return void
     */
    public function addUsersSectionRelatioship($section_id, $user_id)
    {
        $this->startConditions()->insert([
            'section_id' => $section_id,
            'user_id' => $user_id
        ]);
    }

    /**
     * Delete the users-section relatioship for section
     *
     * @param int $section_id
     *
     * @return void
     */
    public function deleteUsersSectionRelatioship($section_id)
    {
        $this->startConditions()
            ->where('section_id', $section_id)
            ->delete();
    }
}