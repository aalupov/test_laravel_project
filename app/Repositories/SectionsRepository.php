<?php
namespace App\Repositories;

use App\Sections as Model;

/**
 * Class SectionsRepository
 *
 * @package App\Repositories
 */
class SectionsRepository extends CoreRepository
{

    /**
     * const array
     */
    private const COLUMNS = [
        'id',
        'name',
        'description',
        'logo'
    ];

    /**
     * const array
     */
    private const COLUMNS_2 = [
        'users_sections_relationships.id',
        'users_sections_relationships.user_id',
        'users_sections_relationships.section_id',
        'users.name'
    ];

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
     * Get the list of the sections
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllSections()
    {
        $result = $this->startConditions()
            ->select(self::COLUMNS)
            ->with([
            'users_section' => function ($query) {
                $query->join('users', 'users.id', '=', 'users_sections_relationships.user_id');
                $query->select(self::COLUMNS_2);
            }
        ])
            ->orderBy('id', 'desc')
            ->get();

        return $result;
    }

    /**
     * Get the section by section id
     *
     * @param int $section_id
     *
     * @return App\Sections
     */
    public function getSectionBySectionId($section_id)
    {
        $result = $this->startConditions()
            ->select(self::COLUMNS)
            ->with([
            'users_section' => function ($query) {
                $query->join('users', 'users.id', '=', 'users_sections_relationships.user_id');
                $query->select(self::COLUMNS_2);
            }
        ])
            ->find($section_id);

        return $result;
    }

    /**
     * Get the logo by section id
     *
     * @param int $id
     *
     * @return App\Sections
     */
    public function getCurrentLogo($id)
    {
        $result = $this->startConditions()
            ->select('logo')
            ->where('id', $id)
            ->first();

        return $result;
    }

    /**
     * Add the new section
     *
     * @param array $data
     *
     * @return int
     */
    public function addSection($data)
    {
        $result = $this->startConditions()->insertGetId([
            'name' => $data['name'],
            'description' => $data['description'],
            'logo' => $data['logo'],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return $result;
    }

    /**
     * Update the section
     *
     * @param array $data
     *
     * @return void
     */
    public function updateSection($id, $data)
    {
        $this->startConditions()
            ->where('id', $id)
            ->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'logo' => $data['logo']
        ]);
    }

    /**
     * Delete the section
     *
     * @param int $id
     *
     * @return void
     */
    public function deleteSection($id)
    {
        $this->startConditions()
            ->find($id)
            ->delete();
    }
}