<?php
declare(strict_types=1);

namespace App\Tests\http;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;

abstract class AbstractTestHttp extends ApiTestCase
{
    protected function createClientWithBasicAuthentification(): Client
    {
        $token = base64_encode('DEV_PHP:THE_GREAT_SECRET');

        return static::createClient([], [
            'headers' => [
                'authorization' => 'Basic ' . $token,
                'content-type' => 'application/json',
                'accept' => 'application/json',
            ]]);
    }

    protected function createDummyClient(): Client
    {
        return static::createClient([], [
            'headers' => [
                'content-type' => 'application/json',
                'accept' => 'application/json',
            ]]);
    }
}
