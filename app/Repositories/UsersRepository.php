<?php
namespace App\Repositories;

use App\User as Model;

/**
 * Class UsersRepository
 *
 * @package App\Repositories
 */
class UsersRepository extends CoreRepository
{

    /**
     * const array
     */
    private const COLUMNS = [
        'id',
        'name',
        'email',
        'updated_at'
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
     * Get the list of the users
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        $result = $this->startConditions()
            ->select(self::COLUMNS)
            ->orderBy('id', 'desc')
            ->get();

        return $result;
    }

    /**
     * Checking of duplicated emails to add
     *
     * @param string $email
     *
     * @return App\User
     */
    public function checkDuplicatedEmailToAdd($email)
    {
        $result = $this->startConditions()
            ->select('id')
            ->where('email', $email)
            ->first();

        return $result;
    }

    /**
     * Checking of duplicated emails to update
     *
     * @param int $id
     * @param string $email
     *
     * @return App\User
     */
    public function checkDuplicatedEmailToUpdate($id, $email)
    {
        $result = $this->startConditions()
            ->select('id')
            ->where('email', $email)
            ->where('id', '!=', $id)
            ->first();

        return $result;
    }
    
    /**
     * Get the user info by user id
     *
     * @param int $id
     *
     * @return App\User
     */
    public function getUserInfoByUserId($id)
    {
        $result = $this->startConditions()
            ->select(self::COLUMNS)
            ->where('id', $id)
            ->first();

        return $result;
    }

    /**
     * Add the new user
     *
     * @param array $data
     *
     * @return void
     */
    public function addUser($data)
    {
        $this->startConditions()->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }

    /**
     * Update the user
     *
     * @param array $data
     *
     * @return void
     */
    public function updateUser($id, $data)
    {
        $this->startConditions()
            ->where('id', $id)
            ->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }

    /**
     * Update the user without password
     *
     * @param array $data
     *
     * @return void
     */
    public function updateUserWithoutPass($id, $data)
    {
        $this->startConditions()
            ->where('id', $id)
            ->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }

    /**
     * Delete the user
     *
     * @param int $id
     *
     * @return void
     */
    public function deleteUser($id)
    {
        $this->startConditions()
            ->find($id)
            ->delete();
    }
}