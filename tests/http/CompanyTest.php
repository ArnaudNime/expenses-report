<?php
declare(strict_types=1);

namespace App\Tests\http;

use App\Entity\Company;
use JsonException;
use PDO;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @see Company
 */
class CompanyTest extends AbstractTestHttp
{
    /**
     * @throws TransportExceptionInterface
     */
    public function testGetCompaniesWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('GET', '/companies');
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetCompaniesWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('GET', '/companies');
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     * @dataProvider CodesNotAllowedForRouteCompanies
     */
    public function testRouteCompaniesWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/companies');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteCompanies(): array
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
     * @dataProvider CodesNotAllowedForRouteCompany
     */
    public function testRouteCompanyWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/company');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteCompany(): array
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
     * @dataProvider CodesNotAllowedForRouteCompanyWithId
     */
    public function testRouteCompanyWithIdWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/company/1');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteCompanyWithId(): array
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
    public function testPostCompanyWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('POST', '/company', [
            "json" => [
                "name" => 'test',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostCompanyWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/company', [
            "json" => [
                "name" => 'test',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetCompanyWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('GET', '/company/1');
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostCompanyWhenDuplicateName(): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/company', [
            "json" => [
                "name" => 'test',
                "email" => 'test2@test.test',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostCompanyWhenDuplicateEmail(): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/company', [
            "json" => [
                "name" => 'test2',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostSecondCompanyWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/company', [
            "json" => [
                "name" => 'test2',
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
    public function testCountOfGetCompaniesWhenAuthorized(): void
    {
        $response = $this->createClientWithBasicAuthentification()->request('GET', '/companies');
        $body = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        self::assertIsArray($body);
        self::assertCount(2, $body);

        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPutCompanyWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('PUT', '/company/1', [
            "json" => [
                "name" => 'test3',
                "email" => 'test2@test.test',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPutCompanyWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('PUT', '/company/1', [
            "json" => [
                "name" => 'test3',
                "email" => 'test@test.test',
            ],
        ]);
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testDeleteSecondCompanyWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('DELETE', '/company/1');
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testDeleteSecondCompanyWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('DELETE', '/company/1');
        self::assertResponseIsSuccessful();
    }

}
