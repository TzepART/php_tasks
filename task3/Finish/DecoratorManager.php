<?php

namespace src\Decorator;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\DataProvider;

/**
 * Class DecoratorManager
 * @package src\Decorator
 */
class DecoratorManager
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * @param DataProvider $dataProvider
     * @param CacheItemPoolInterface $cache
     * @param LoggerInterface $logger
     */
    public function __construct(DataProvider $dataProvider, CacheItemPoolInterface $cache, LoggerInterface $logger)
    {
        $this->dataProvider = $dataProvider;
        $this->cache = $cache;
        $this->logger = $logger;
    }


    /**
     * @param array $input
     * @return array
     */
    public function getResponse(array $input)
    {
        $result = [];
        try {
            $cacheKey = $this->getCacheKey($input);
            $cacheItem = $this->cache->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                $result = $cacheItem->get();
            }else{
                $result = $this->dataProvider->get($input);
                $cacheItem
                    ->set($result)
                    ->expiresAt(
                        (new DateTime())->modify('+1 day')
                    );
            }
        }catch(\InvalidArgumentException $e) {
            $this->logger->critical($e->getMessage());
        }catch (Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $result;
    }


    /**
     * @param array $input
     * @return string
     */
    private function getCacheKey(array $input)
    {
        return json_encode($input);
    }
}