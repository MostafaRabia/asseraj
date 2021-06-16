<?php

namespace App\Traits;

trait CrcemailTrait
{
    public function crcemail($email)
    {
        $email = strtolower($email);
        $emailNormalizer = new \Gabrola\EmailNormalizer\EmailNormalizer(new \Gabrola\EmailNormalizer\EmailRules());
        $email = $emailNormalizer->normalize($email);

        return [$email, crc32(strtolower($email)) + 9807923435];
    }
}
