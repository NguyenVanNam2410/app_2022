<?php


namespace App\Services\thematic;

use App\Repositories\ThematicRepository;


class thematicService
{
    private $ThematicRepository;
    public function __construct(ThematicRepository $ThematicRepository)
    {
        $this->ThematicRepository = $ThematicRepository;
    }
    public function getAll($limit, $orders = [])
    {
        return $this->ThematicRepository->getPaginate($limit, $orders);
    }
    public function get($id, $relations = [])
    {
        return $this->ThematicRepository->getById($id, $relations);
    }
    public function updateId($data, $id)
    {
        return $this->ThematicRepository->update($data, $id);
    }
    public function createThematic($data)
    {
        return $this->ThematicRepository->create($data);
    }
}