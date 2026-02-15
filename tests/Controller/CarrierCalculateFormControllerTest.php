<?php

namespace App\Tests\Controller;

use App\Application\CarrierService\CalculateShippingCosts\CalculateCommand;
use App\Application\CarrierService\CalculateShippingCosts\CalculateView;
use App\Controller\CarrierCalculateFormController\Dto;
use App\Controller\CarrierCalculateFormController\SuccessDto;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CarrierCalculateFormControllerTest extends WebTestCase
{
    public function testCalculateShippingCostsSuccess(): void
    {
        $slugField = CalculateCommand::slugField;
        $weightField  = CalculateCommand::weightField;
        $client = static::createClient();
        $client->request('POST', '/api/shipping/calculate', [
            $weightField => 10,
            $slugField => 'transcompany',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');

        $content = $client->getResponse()->getContent();
        $responseData = json_decode($content, true);
        $status = $responseData[Dto::STATUS_FIELD];
        $result = $responseData[Dto::RESULT_FIELD];

        $this->assertSame(Dto::SUCCESS_FIELD, $status);

        $this->assertSame('transcompany', $result[$slugField]);
        $this->assertSame(10, $result[$weightField]);
        $this->assertSame('EUR', $result[CalculateView::CURRENCY_FIELD]);
        $this->assertSame(20, $result[CalculateView::PRICE_FIELD]);
    }
}
