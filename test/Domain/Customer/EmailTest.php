<?php

namespace Test\Domain\Customer;

use OrderManager\Domain\Customer\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{

  /**
   * @dataProvider invalidEmailList
   */
  public function testThrowExceptionIfEmailIsInvalid($invalidEmailAdress, $errorMessage)
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage($errorMessage);
    
    new Email($invalidEmailAdress);
  }

  public static function invalidEmailList()
  {
    return [
      "EmailWithoutName" => ['@email.com', 'O endereço de e-mail informado não está completo, informe um endereço de e-mail válido!'],
      "EmailWithoutProvider" => ['nome@', 'O endereço de e-mail informado não está completo, informe um endereço de e-mail válido!'],
      "EmailTooLong" => ['emailemailemailemailemailemailemailemailemail@provider.com', 'O endereço de e-mail informado é muito longo!' ],
      "EmailTooShort" => ['e@e.com', 'O endereço de e-mail informado é muito curto!']
    ];
  }
}