<?php declare(strict_types = 1);
/**
 * @category     Helpers
 * @package      PassGen
 * @copyright    Copyright (c) 2017 Bentler Design (www.bricebentler.com)
 * @author       Brice Bentler <me@bricebentler.com>
 */

namespace BentlerDesign\Helpers;

use InvalidArgumentException;

class StringsHelper
{
    const ALPHABET = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';

    /**
     * @param int $length
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function randomPassword(int $length = 12): string
    {
        if ($length < 1) {
            throw new InvalidArgumentException('Length must be an integer greater than zero.');
        }

        $pass = [];
        $alphaLength = strlen(self::ALPHABET) - 1;

        for ($i = 0; $i < $length; $i++) {
            $pass[] = self::ALPHABET[mt_rand(0, $alphaLength)];
        }

        return implode($pass);
    }
}
