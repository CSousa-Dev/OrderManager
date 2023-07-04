<?php

namespace OrderManager\Domain\Product;
use OrderManager\Domain\Helpers\DataValidator;

class Product implements ProductInterface
{
  use DataValidator;

  private string $uuid;
  private string $name;
  private string $description;
  private string $price;

  public function __construct(string $name, string $description, float $price, string | null $uuid = null)
  {
    $this->validateName($name);
    $this->name = $name;

    $this->validateDescription($description);
    $this->description = $description;

    $this->validatePrice($price);
    $this->price = $price;

    $this->setUuid($uuid);
  }

  private function validateName($name)
  {
    $this->throwExceptionIfStringValueLessThan($name, 8, 'O nome do produto informado é muito curto!');
    $this->throwExceptionIfStringValueGreaterThan($name, 55, 'O nome do produto informado é muito longo!');
  }

  private function validateDescription($description)
  {
    $this->throwExceptionIfStringValueLessThan($description, 55, 'A descrição do produto informado é muito curta!');
    $this->throwExceptionIfStringValueGreaterThan($description, 255, 'A descrição do produto informado é muito longa!');
  }

  private function validatePrice($price)
  {
    $this->throwExceptionIfValueIsEmpty($price, 'O valor de um produto não pode ser nulo!');
    $this->throwExceptionIfValueLessThan($price, 0, 'O valor de um produto não pode ser negativo!');
  }

  private function setUuid(string | null $uuid)
  { 
    $isNewUuidRequired = $uuid == null;

    if($isNewUuidRequired){
      $this->uuid = uniqid();
      return;
    }

    $this->validateUuid($uuid);
    $this->uuid = $uuid;
  }

  private function validateUuid($uuid)
  {
    $this->throwExceptionIfLengthValueNotEqualTo($uuid, 13, 'O id do produto informado não é valido!');
  }

  public function name(): string
  {
    return $this->name;
  }

  public function description(): string
  {
    return $this->description;
  }

  public function price(): string
  {
    return $this->price;
  }

  public function id(): string
  {
    return $this->uuid;
  }
}