<?php

namespace Test\Domain\Customer;

use OrderManager\Domain\Customer\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{

  /**
   * @dataProvider invalidNamesList
   */
  public function testThrowExceptionIfNameIsInvalid(string $invalidCustomerName, string $errorMessage)
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage($errorMessage);
    
    new Customer($invalidCustomerName);
  }

  public function testValidNameReturn()
  {
    $customer = new Customer('Renato Sousa');
    $this->assertEquals('Renato Sousa', $customer->name());
  }

  public static function invalidNamesList()
  {
    return  [
      "EmptyName" => ['', 'É necessário informar nome e sobrenome para um cliente.'],
      "MissingLastName" => ['Renato', 'É necessário informar nome e sobrenome para um cliente.'],
      "TooShortName" => ['Ren ato', 'O nome informado é muito curto!'],
      "TooLongName" => ['xxx xxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxx', 'O nome informado é muito longo!']
    ];
  }
} 