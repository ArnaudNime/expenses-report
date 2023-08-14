<?php
declare(strict_types=1);

namespace App\Tests\http;

use App\Entity\Commercial;
use JsonException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @see Commercial
 */
class CommercialTest extends AbstractTestHttp
{
    /**
     * @throws TransportExceptionInterface
     */
    public function testGetCommercialsWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('GET', '/commercials');
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetCommercialsWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('GET', '/commercials');
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     * @dataProvider CodesNotAllowedForRouteCommercials
     */
    public function testRouteCommercialsWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/commercials');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteCommercials(): array
    {
        return [
            ['POST'],
            ['PATCH'],
            ['PUT'],
            ['OPTIONS'],
            ['DELETE'],
        ];
    }

    /**
     * @throws TransportExceptionInterface
     * @dataProvider CodesNotAllowedForRouteCommercial
     */
    public function testRouteCommercialWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/commercial');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteCommercial(): array
    {
        
        return [
            ['GET'],
            ['PATCH'],
            ['PUT'],
            ['OPTIONS'],
            ['DELETE'],
        ];
    }

    /**
     * @throws TransportExceptionInterface
     * @dataProvider CodesNotAllowedForRouteCommercialWithId
     */
    public function testRouteCommercialWithIdWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/commercial/1');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteCommercialWithId(): array
    {
        return [
            ['POST'],
            ['PATCH'],
            ['OPTIONS'],
        ];
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostCommercialWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('POST', '/commercial', [
            "json" => [
                "firstname" => 'test',
                "lastname" => 'test',
                "birthdate" => '1990-12-17',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostCommercialWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/commercial', [
            "json" => [
                "firstname" => 'test',
                "lastname" => 'test',
                "birthdate" => '1990-12-17',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetCommercialWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('GET', '/commercial/1');
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostCommercialWhenDuplicateEmail(): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/commercial', [
            "json" => [
                "firstname" => 'test2',
                "lastname" => 'test2',
                "birthdate" => '1990-12-17',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostCommercialWhenBirthdateIsNotLogical(): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/commercial', [
            "json" => [
                "firstname" => 'test2',
                "lastname" => 'test2',
                "birthdate" => '2045-12-17',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostSecondCommercialWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/commercial', [
            "json" => [
                "firstname" => 'test2',
                "lastname" => 'test2',
                "birthdate" => '1990-12-17',
                "email" => 'test2@test.test',
            ],
        ]);
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testCountOfGetCommercialsWhenAuthorized(): void
    {
        $response = $this->createClientWithBasicAuthentification()->request('GET', '/commercials');
        $body = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        self::assertIsArray($body);
        self::assertCount(2, $body);

        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPutCommercialWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('PUT', '/commercial/1', [
            "json" => [
                "firstname" => 'test2',
                "lastname" => 'test4',
                "birthdate" => '1990-12-17',
                "email" => 'test2@test.test',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPutCommercialWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('PUT', '/commercial/1', [
            "json" => [
                "firstname" => 'test2',
                "lastname" => 'test4',
                "birthdate" => '1990-12-17',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testDeleteSecondCommercialWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('DELETE', '/commercial/1');
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testDeleteSecondCommercialWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('DELETE', '/commercial/1');
        self::assertResponseIsSuccessful();
    }
}
