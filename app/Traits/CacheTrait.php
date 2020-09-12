<?php
/**
 * Created by PhpStorm.
 * User: Jormin
 * Date: 2018/10/31
 * Time: 2:09 PM
 */

namespace App\Traits;

/**
 * 缓存处理Trait
 * @package app\Traits
 */
trait CacheTrait
{

    /**
     * @var \Redis 缓存池对象
     */
    private $cachePool;

    /**
     * 初始化缓存连接池
     */
    private function init()
    {
        $this->cachePool = $this->cachePool ?? get_instance()->redis_pool->getCoroutine();
    }

    /**
     * 设置缓存
     * @param $key
     * @param $value
     * @param int|null $timeout
     * @param bool $overwrite
     * @return bool
     */
    public function setCache($key, $value, int $timeout = null, bool $overwrite = true)
    {
        if (empty($value)) {
            return false;
        }
        $this->init();
        if ($timeout) {
            $result = yield $this->cachePool->setex($key, $timeout, $value);
        } elseif (!$overwrite) {
            $result = yield $this->cachePool->setnx($key, $value);
        } else {
            $result = yield $this->cachePool->set($key, $value);
        }
        return $result === 'OK';
    }

    /**
     * 读取缓存
     * @param $key
     * @return mixed
     */
    public function getCache($key)
    {
        $this->init();
        $result = yield $this->cachePool->get($key);
        return $result;
    }

    /**
     * 判断缓存是否存在
     * @param $key
     * @return mixed
     */
    public function existsCache($key)
    {
        $this->init();
        $result = yield $this->cachePool->exists($key);
        return $result;
    }

    /**
     * 缓存值增1
     * @param $key
     */
    public function incrCache($key)
    {
        $this->init();
        $this->cachePool->incr($key);
    }

    /**
     * 缓存值减1
     * @param $key
     */
    public function decrCache($key)
    {
        $this->init();
        $this->cachePool->decr($key);
    }

    /**
     * 删除缓存
     * @param array ...$key
     * @return mixed
     */
    public function delCache(...$key)
    {
        $this->init();
        $result = yield $this->cachePool->del(...$key);
        return $result;
    }

    /**
     * 左侧入队
     * @param $key
     * @param array ...$value
     * @return mixed
     */
    public function lpushCache($key, ...$value)
    {
        $this->init();
        $result = yield $this->cachePool->lpush($key, ...$value);
        return $result;
    }

    /**
     * 将值插入列表头部，key不存在时入队无效
     * @param $key
     * @param $value
     * @return mixed
     */
    public function lpushxCache($key, $value)
    {
        $this->init();
        $result = yield $this->cachePool->lpushx($key, $value);
        return $result;
    }

    /**
     * 左侧出队
     * @param $key
     * @return mixed
     */
    public function lpopCache($key)
    {
        $this->init();
        $result = yield $this->cachePool->lpop($key);
        return $result;
    }

    /**
     * 右侧入队
     * @param $key
     * @param array ...$value
     * @return mixed
     */
    public function rpushCache($key, ...$value)
    {
        $this->init();
        $result = yield $this->cachePool->rpush($key, ...$value);
        return $result;
    }

    /**
     * 将值插入列表尾部，key不存在时入队操作无效
     * @param $key
     * @param $value
     * @return mixed
     */
    public function rpushxCache($key, $value)
    {
        $this->init();
        $result = yield $this->cachePool->rpushx($key, $value);
        return $result;
    }

    /**
     * 右侧出队
     * @param $key
     * @return mixed
     */
    public function rpopCache($key)
    {
        $this->init();
        $result = yield $this->cachePool->rpop($key);
        return $result;
    }

    /**
     * 获取列表长度
     * @param $key
     * @return mixed
     */
    public function llenCache($key)
    {
        $this->init();
        $result = yield $this->cachePool->llen($key);
        return $result;
    }

    /**
     * 根据索引获取列表中元素
     * @param $key
     * @param $index
     * @return mixed
     */
    public function lindexCache($key, $index)
    {
        $this->init();
        $result = yield $this->cachePool->lindex($key, $index);
        return $result;
    }

    /**
     * 获取列表指定范围内的元素
     * @param $key
     * @param $start
     * @param $end
     * @return mixed
     */
    public function lrange($key, $start, $end)
    {
        $this->init();
        $result = yield $this->cachePool->lrange($key, $start, $end);
        return $result;
    }

    /**
     * 根据count的值移除列表中与给定值相等的元素
     * @param $key
     * @param $count
     * @param $value
     * @return mixed
     */
    public function lremCache($key, $count, $value)
    {
        $this->init();
        $result = yield $this->cachePool->lrem($key, $count, $value);
        return $result;
    }

    /**
     * 读取缓存中的满足条件的Key值
     * @param string $pattern
     * @return mixed
     */
    public function keysCache($pattern = '*')
    {
        $this->init();
        $result = yield $this->cachePool->keys($pattern);
        return $result;
    }

}
