<?php

namespace OrderManager\Domain\Product;

interface ProductInterface
{
  public function name(): string;
  public function description(): string;
  public function id(): string;
  public function price(): string;
} 