<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/11/14
 * Time: 3:09 PM
 */

namespace App\Models\Dao;


use App\Models\Entity\Kefu;
use Swoft\Bean\Annotation\Bean;

/**
 * Class KefuDao
 * @package App\Models\Dao
 * @Bean()
 */
class KefuDao
{

    /**
     * 根据ID查询
     * @param $id
     * @return mixed
     */
    public function getKefu($id){
        $kefu = Kefu::findById($id)->getResult();
        return $kefu;
    }

    /**
     * 添加客服
     * @param $data
     * @return Kefu|mixed
     */
    public function createKefu($data){
        $kefu = new Kefu();
        $kefu->setCreateTime(time());
        $result = $kefu->fill($data)->save()->getResult();
        return $result ? $kefu : false;
    }

}