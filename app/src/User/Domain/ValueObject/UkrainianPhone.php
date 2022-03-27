<?php
declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use App\User\Domain\ValueObject\Exception\InvalidPhoneNumberLengthException;
use App\User\Domain\ValueObject\Exception\PhoneNumberShouldStartWithException;

class UkrainianPhone extends Phone
{
    protected const NUMBER_LENGTH = 12;
    protected const SHORT_LENGTH = 10;

    protected const FIRST_DIGIT = ['3', '0'];

    /**
     * {@inheritDoc}
     */
    protected function validate(string $phone): void
    {
        parent::validate($phone);

        $this->checkLength($phone);
        $this->checkFirstDigit($phone);
    }

    /**
     * {@inheritDoc}
     */
    protected function normalizeNumber(string $phone): string
    {
        $phone = $this->clearPhone($phone);
        $firstChar = $phone[0];
        if(!$firstChar) {
            $operator = substr($phone, 0, 3);
            $prefix = substr($phone, 3, 3);
            $number = substr($phone, 6, 4);
        }else{
            $operator = substr($phone, 2, 3);
            $prefix = substr($phone, 5, 3);
            $number = substr($phone, 8, 4);
        }


        return sprintf('+38 (%s)-%s-%s', $operator, $prefix, $number);
    }

    /**
     * @param string $phone
     * @return void
     * @throws InvalidPhoneNumberLengthException
     */
    protected function checkLength(string $phone): void
    {
        $length = strlen($this->clearPhone($phone));

        if (self::NUMBER_LENGTH !== $length && self::SHORT_LENGTH !== $length) {
            throw new InvalidPhoneNumberLengthException($phone, self::NUMBER_LENGTH, $length);
        }
    }

    /**
     * @param string $phone
     * @throws PhoneNumberShouldStartWithException
     */
    protected function checkFirstDigit(string $phone): void
    {
        $firstChar = substr($this->clearPhone($phone), 0, 1);
        if (!in_array($firstChar, self::FIRST_DIGIT)) {
            throw new PhoneNumberShouldStartWithException($phone);
        }
    }
}