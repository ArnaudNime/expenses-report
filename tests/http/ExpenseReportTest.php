<?php
declare(strict_types=1);

namespace App\Tests\http;

use App\Entity\Enum\ExpenseReportsType;
use App\Entity\ExpenseReport;
use JsonException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @see ExpenseReport
 */
class ExpenseReportTest extends AbstractTestHttp
{
    /**
     * @throws TransportExceptionInterface
     */
    public function testGetExpenseReportsWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('GET', '/expense-reports');
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetExpenseReportsWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('GET', '/expense-reports');
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     * @dataProvider CodesNotAllowedForRouteExpenseReports
     */
    public function testRouteExpenseReportsWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/expense-reports');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteExpenseReports(): array
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
     * @dataProvider CodesNotAllowedForRouteExpenseReport
     */
    public function testRouteExpenseReportWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/expense-report');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteExpenseReport(): array
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
     * @dataProvider CodesNotAllowedForRouteExpenseReportWithId
     */
    public function testRouteExpenseReportWithIdWhenNotAllowed(string $httpCode): void
    {
        $this->createClientWithBasicAuthentification()->request($httpCode, '/expense-report/1');
        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED, '');
    }

    public static function CodesNotAllowedForRouteExpenseReportWithId(): array
    {
        return [
            ['POST'],
            ['OPTIONS'],
        ];
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostExpenseReportWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('POST', '/expense-report', [
            "json" => [
                "amount" => 10,
                "type" => ExpenseReportsType::Meat,
                "company" => '/company/4',
                "commercial" => '/commercial/3',
                "payment_date" => '2023-08-11',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @dataProvider getExpenseReportsType
     * @throws TransportExceptionInterface
     */
    public function testPostExpenseReportWhenAuthorized(float $amount, ExpenseReportsType $type): void
    {
        $this->createClientWithBasicAuthentification()->request('POST', '/expense-report', [
            "json" => [
                "amount" => $amount,
                "type" => $type,
                "company" => '/company/4',
                "commercial" => '/commercial/3',
                "payment_date" => '2023-08-11',
            ],
        ]);
        self::assertResponseIsSuccessful();
    }

    public static function getExpenseReportsType(): array
    {
        return [
            [10, ExpenseReportsType::Meat],
            [60, ExpenseReportsType::Gazoline],
            [20.25, ExpenseReportsType::Toll],
            [100, ExpenseReportsType::Conference],
        ];
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetExpenseReportWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('GET', '/expense-report/1');
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostExpenseReportWhenUnknownCompany(): void
    {

        $this->createClientWithBasicAuthentification()->request('POST', '/expense-report', [
            "json" => [
                "amount" => 10,
                "type" => ExpenseReportsType::Meat,
                "company" => '/company/1',
                "commercial" => '/commercial/3',
                "payment_date" => '2023-08-11',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPostExpenseReportWhenUnknownCommercial(): void
    {

        $this->createClientWithBasicAuthentification()->request('POST', '/expense-report', [
            "json" => [
                "amount" => 10,
                "type" => ExpenseReportsType::Meat,
                "company" => '/company/4',
                "commercial" => '/commercial/1',
                "payment_date" => '2023-08-11',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testCountOfGetExpenseReportsWhenAuthorized(): void
    {
        $response = $this->createClientWithBasicAuthentification()->request('GET', '/expense-reports');
        $body = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        self::assertIsArray($body);
        self::assertCount(4, $body);

        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPutExpenseReportWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('PUT', '/expense-report/2', [
            "json" => [
                "amount" => 50,
                "type" => ExpenseReportsType::Gazoline,
                "company" => '/company/4',
                "commercial" => '/commercial/3',
                "payment_date" => '2023-08-11',
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPutExpenseReportWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('PUT', '/expense-report/2', [
            "json" => [
                "amount" => 50,
                "type" => ExpenseReportsType::Gazoline,
                "company" => '/company/4',
                "commercial" => '/commercial/3',
                "payment_date" => '2023-08-11',
            ],
        ]);
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPatchExpenseReportWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('PATCH', '/expense-report/2', [
            "json" => [
                "amount" => 55,
            ],
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testPatchExpenseReportWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('PUT', '/expense-report/2', [
            "json" => [
                "amount" => 55,
            ],
        ]);
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testDeleteSecondExpenseReportWhenUnauthorized(): void
    {
        $this->createDummyClient()->request('DELETE', '/expense-report/1');
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testDeleteSecondExpenseReportWhenAuthorized(): void
    {
        $this->createClientWithBasicAuthentification()->request('DELETE', '/expense-report/1');
        self::assertResponseIsSuccessful();
    }
}
