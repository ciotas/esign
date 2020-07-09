<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Grid;
use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\User as UserModel;

class User extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = UserModel::class;

    /**
     * 定义主键字段名称
     *
     * @return string
     */
    public function getKeyName()
    {
        return 'id';
    }


    /**
     * @return array
     * 指定查询的字段
     */
    public function getGridColumns(){
        return [$this->getKeyName(), 'mobile', 'email'];
    }

    /**
     * @return array
     * 指定表单页查询的字段
     */
    public function getFormColumns()
    {
        return ['*'];
    }

    /**
     * @return array
     * 指定详情页查询的字段
     */
    public function getDetailColumns()
    {
        return ['*'];
    }
}
