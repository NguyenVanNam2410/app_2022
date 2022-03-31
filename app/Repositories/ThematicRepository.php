<?php
namespace App\Repositories;

use App\Models\thematic;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

class ThematicRepository extends BaseRepository{

    public function __construct(thematic $model) 
    {
        parent::__construct($model);
    }

}
