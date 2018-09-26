<?php
namespace Realtime;

use Ratchet\ConnectionInterface;

abstract class ConnectionInformationService
{
    static public function checkInformations(ConnectionInterface $connection)
    {
        $queryExplode = explode('&', $connection->WebSocket->request->getQuery());
        $queryParams = new \stdClass();
        foreach ($queryExplode as $queryParam) {
            $queryParamExplode = explode('=', $queryParam);
            $queryParamKey = $queryParamExplode[0];
            array_shift($queryParamExplode);
            $queryParamValue = implode($queryParamExplode);
            $queryParamKey ? $queryParams->{$queryParamKey} = $queryParamValue : null;
        }
        if (!property_exists($queryParams, 'name')) return false;
        if (!property_exists($queryParams, 'room')) return false;
        return $queryParams;
    }
}