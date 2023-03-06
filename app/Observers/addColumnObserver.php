<?php

namespace App\Observers;

class addColumnObserver
{
    public $userID,$model;
    public function __construct($model,$id)
    {
        $this->userID = $id;
        $this->model  = $model;

    }

    public function creating($model): void
    {
        $model->created_by = $this->userID;
        $model->created_by = $this->userID;
    }
    public function updating($model): void
    {
        $model->created_by = $this->userID;
        $model->created_by = $this->userID;
    }
}
