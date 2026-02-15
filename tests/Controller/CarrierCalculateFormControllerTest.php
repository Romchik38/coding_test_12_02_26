<?php

namespace App\Tests\Controller;

use App\Application\CarrierService\CalculateShippingCosts\CalculateCommand;
use App\Application\CarrierService\CalculateShippingCosts\CalculateView;
use App\Controller\CarrierCalculateFormController\Dto;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CarrierCalculateFormControllerTest extends WebTestCase
{
    public function testCalculateShippingCostsSuccess(): void
    {
        $slugField = CalculateCommand::slugField;
        $weightField  = CalculateCommand::weightField;
        $carrierSlug = 'testcompany1';
        $weight = 10;
        $client = static::createClient();
        $client->request('POST', '/api/shipping/calculate', [
            $weightField => $weight,
            $slugField => $carrierSlug,
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');

        $content = $client->getResponse()->getContent();
        $responseData = json_decode($content, true);
        $status = $responseData[Dto::STATUS_FIELD];
        $result = $responseData[Dto::RESULT_FIELD];

        $this->assertSame(Dto::SUCCESS_FIELD, $status);

        $this->assertSame($carrierSlug, $result[$slugField]);
        $this->assertSame($weight, $result[$weightField]);
        $this->assertSame('EUR', $result[CalculateView::CURRENCY_FIELD]);
        $this->assertSame($weight, $result[CalculateView::PRICE_FIELD]);
    }

    public function testCalculateShippingCostsErrorSlug(): void
    {
        $slugField = CalculateCommand::slugField;
        $weightField  = CalculateCommand::weightField;
        $carrierSlug = 'testcompany10';  // wrong
        $weight = 10;
        $client = static::createClient();
        $client->request('POST', '/api/shipping/calculate', [
            $weightField => $weight,
            $slugField => $carrierSlug,
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/json');

        $content = $client->getResponse()->getContent();
        $responseData = json_decode($content, true);
        $status = $responseData[Dto::STATUS_FIELD];

        $this->assertSame(Dto::ERROR_FIELD, $status);
    }

    public function testCalculateShippingCostsErrorWeight(): void
    {
        $slugField = CalculateCommand::slugField;
        $weightField  = CalculateCommand::weightField;
        $carrierSlug = 'testcompany1';
        $weight = 0; // wrong
        $client = static::createClient();
        $client->request('POST', '/api/shipping/calculate', [
            $weightField => $weight,
            $slugField => $carrierSlug,
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/json');

        $content = $client->getResponse()->getContent();
        $responseData = json_decode($content, true);
        $status = $responseData[Dto::STATUS_FIELD];

        $this->assertSame(Dto::ERROR_FIELD, $status);
    }
}
