<?php

namespace App\Repositories;


//use Your Model

/**
 * Class UserRepositoryInterface.
 */
interface UserRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function model();

    public function getAll();

    public function find($id);

    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
