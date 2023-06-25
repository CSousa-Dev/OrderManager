<?php

namespace OrderManager\Domain\Customer;

class Cpf 
{
  private string $number; 
  public function __construct(string $possibleCpf) 
  {
    $possibleCpf = $this->getOnlyNumbers($possibleCpf);
    $this->has11Digits($possibleCpf);
    $this->areAllNumbersEqual($possibleCpf);
    $this->cpfValidationRule($possibleCpf);
    $this->number = $possibleCpf;
  }

  private function getOnlyNumbers(string $possibleCpf){
    $possibleCpf = preg_replace('/[^0-9]/', "", $possibleCpf);
    return $possibleCpf;
  }

  private function has11Digits(string $possibleCpf) 
  {
    if (strlen($possibleCpf) != 11) {
      throw new \InvalidArgumentException('O CPF deve possuir 11 digitos.');
    }
  }
  
  private function areAllNumbersEqual(string $possibleCpf)
  {
    if (preg_match('/([0-9])\1{10}/', $possibleCpf)) {
      throw new \InvalidArgumentException('O CPF informado possui todos os digitos iguais!');
    }    
  }

  private function cpfValidationRule($possibleCpf)
  {
    $number_quantity_to_loop = [9, 10];

    foreach ($number_quantity_to_loop as $item) {
      $sum = 0;
      $number_to_multiplicate = $item + 1;
    
      for ($index = 0; $index < $item; $index++) {
          $sum += $possibleCpf[$index] * ($number_to_multiplicate--);
      }
      $result = (($sum * 10) % 11);

      if($result == 10){
        $result = 0;
      }
      
      if ($possibleCpf[$item] != $result) {
        throw new \InvalidArgumentException('O CPF informado não é valido!');
      }
    }
  }

  public function __toString()
  {
    return $this->number;
  }
}