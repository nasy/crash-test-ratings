<?php

namespace Tests\AppBundle\Validator;

use AppBundle\Validator\PostVehiclesValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostVehiclesValidatorTest extends WebTestCase
{
    public function testClassWithCorrectParams()
    {
        $year = 2015;
        $manufacturer = 'Audi';
        $model ='A4';
        $withRating = true;
        $validator = new PostVehiclesValidator(json_encode([
                'year' => $year,
                'manufacturer' => $manufacturer,
                'model' => $model
        ]), $withRating);
        $this->assertSame(PostVehiclesValidator::class, get_class($validator));
        $this->assertSame($year, $validator->year());
        $this->assertSame($manufacturer, $validator->manufacturer());
        $this->assertSame($model, $validator->model());
        $this->assertSame($withRating, $validator->withRating());
    }

    public function testClassWithWrongParams()
    {
        $year = 'WRONG';
        $manufacturer = 1;
        $model = 2;
        $withRating = "true";
        $validator = new PostVehiclesValidator(json_encode([
            'year' => $year,
            'manufacturer' => $manufacturer,
            'model' => $model
        ]), $withRating);
        $this->assertSame(PostVehiclesValidator::class, get_class($validator));
        $this->assertSame(null, $validator->year());
        $this->assertSame(null, $validator->manufacturer());
        $this->assertSame(null, $validator->model());
        $this->assertSame(true, $validator->withRating());
    }

    public function testClassWithRatingFalse()
    {
        $year = 'WRONG';
        $manufacturer = 1;
        $model = 2;
        $withRating = "false";
        $validator = new PostVehiclesValidator(json_encode([
            'year' => $year,
            'manufacturer' => $manufacturer,
            'model' => $model
        ]), $withRating);
        $this->assertSame(PostVehiclesValidator::class, get_class($validator));
        $this->assertSame(false, $validator->withRating());
    }
}
