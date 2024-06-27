<?php
/**
 * Created by PhpStorm.
 * User: bizmate
 * Date: 22/03/22
 * Time: 14:18
 */
namespace ValueObjects\Util;

trait JsonSerializableToString
{
    public function jsonSerialize(): mixed
    {
        return $this->__toString();
    }
}
