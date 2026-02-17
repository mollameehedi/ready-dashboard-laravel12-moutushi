<?php

namespace App\Enums;

trait Commons
{
    public static function getKeys(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    public static function asSelectArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }

    public static function fromValue(int $value) : self
    {
        return self::from($value);
    }

    public static function fromKey($key) : ?self
    {
        foreach (self::cases() as $case) {
            if ($case->name == $key) return $case;
        }
        return null;
    }

    public static function getRandom() : self
    {
        return self::cases()[array_rand(self::cases())];
    }


    public static function getInstances(){
        $array = collect();
        foreach (self::cases() as $item) {
            $array[$item->value] = $item->name; // Key-value pair
        }
        return $array;
    }

    public function is(self $other): bool
    {
        return $this->value === $other->value;
    }

}
