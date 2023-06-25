<?php

namespace Test\Domain\Customer;

use OrderManager\Domain\Customer\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{

  /**
   * @dataProvider incorrectsNamesGenerator
   */
  public function testThrowExceptionIfNameIsInvalid(string $invalidCustomerName, string $errorMessage)
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage($errorMessage);
    
    new Customer($invalidCustomerName);
  }


  public static function incorrectsNamesGenerator()
  {
    return  [
      "EmptyName" => ['', 'É necessário informar nome e sobrenome para um cliente.'],
      "MissingLastName" => ['Renato', 'É necessário informar nome e sobrenome para um cliente.'],
      "TooShortName" => ['Ren ato', 'O nome informado é muito curto!'],
      "TooLongName" => ['xxx xxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxx', 'O nome informado é muito longo!']
    ];
  }
} 