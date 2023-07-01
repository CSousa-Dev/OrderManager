<?php

namespace Test\Domain\Product;

use PHPUnit\Framework\TestCase;
use OrderManager\Domain\Product\Product;

class ProductTest extends TestCase
{
  private string $validName = 'Teclado F3520';
  private string $validDescription = 'Teclado mecânico fluorescente com entrada USB e cores RGBA em Led.';
  private float $validPrice = 100;

  /**
   * @dataProvider invalidNameList
   */
  public function testThrowExceptionIfNameIsInvalid($invalidName, $exceptionMessage)
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage($exceptionMessage);

    new Product($invalidName, $this->validDescription, $this->validPrice);
  }

  /**
   * @dataProvider invalidDescriptionList
   */
  public function testThrowExceptionIfDescriptionIsInvalid($invalidDescription, $exceptionMessage)
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage($exceptionMessage);

    new Product($this->validName, $invalidDescription, $this->validPrice);
  }

  /**
   * @dataProvider invalidPriceList
   */
  public function testThrowExceptionIfPriceIsInvalid($invalidPrice, $exceptionMessage)
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage($exceptionMessage);

    new Product($this->validName, $this->validDescription, $invalidPrice);
  }

  /**
   * @dataProvider invalidIdList
   */
  public function testThrowExceptionIfIdIsInvalid($invalidId)
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage('O id do produto informado não é valido!');

    new Product($this->validName, $this->validDescription, $this->validPrice, $invalidId);
  }

  public function testValidNameReturn()
  {
    $product = new Product($this->validName, $this->validDescription, $this->validPrice);
    $this->assertEquals($this->validName, $product->name());
  }

  public function testValidDescriptionReturn()
  {
    $product = new Product($this->validName, $this->validDescription, $this->validPrice);
    $this->assertEquals($this->validDescription, $product->description());
  }

  public function testValidPriceReturn()
  {
    $product = new Product($this->validName, $this->validDescription, $this->validPrice);
    $this->assertEquals($this->validPrice, $product->price());
  }

  public function testValidIdReturn()
  {
    $validId = uniqid();
    $product = new Product($this->validName, $this->validDescription, $this->validPrice, $validId);
    $this->assertEquals($validId, $product->id());
  }

  public function testIsIdGeneratedAutomatically()
  {
    $product = new Product($this->validName, $this->validDescription, $this->validPrice);
    $this->assertNotEmpty($product->id());
    $this->assertLessThanOrEqual(13, strlen($product->id()));
  }

  public static function invalidNameList()
  {
    return [
      "TooShortName" => ['abac', 'O nome do produto informado é muito curto!'],
      "TooLongName" => ['xxx xxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxx', 'O nome do produto informado é muito longo!']
    ];
  }

  public static function invalidDescriptionList()
  {
    return [
      "TooShortDescription" => ['Camiseta Estampada de Verão, para todos os publicos!!', 'A descrição do produto informado é muito curta!'],
      "TooLongDescription" => ['Esta é uma descrição de produto com 256 caracteres para fins de demonstração. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce a sem non leo efficitur consectetur. Curabitur ac tristique nisl, at fermentum elit. Mauris ac nunc non sem ult con', 'A descrição do produto informado é muito longa!']
    ];
  }

  public static function invalidPriceList()
  {
    return [
      "NegativeNumber" => [-1, 'O valor de um produto não pode ser negativo!'],
      "ZeroNumber" => [0, 'O valor de um produto não pode ser nulo!']
    ];
  }

  public static function invalidIdList()
  {
    return [
      "TooShortId" => ['123456789101'],
      "TooLongId" => ['12345678910111']
    ];
  }
}
