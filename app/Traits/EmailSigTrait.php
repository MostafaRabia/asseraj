<?php

namespace App\Traits;

trait EmailSigTrait
{
    use CrcemailTrait;

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = encrypt($value);
        $this->attributes['emailsig'] = $this->crcemail($value)[1];
    }

    public function getEmailAttribute()
    {
        return decrypt($this->attributes['email']);
    }

    protected function findByEmailSig($email)
    {
        list($email, $emailsig) = $this->crcemail($email);

        $emailNormalizer = new \Gabrola\EmailNormalizer\EmailNormalizer(new \Gabrola\EmailNormalizer\EmailRules());

        $candidate = parent::where('emailsig', $emailsig)->first();
        $candidate_email = strtolower(optional($candidate)->email);
        $candidate_email = $emailNormalizer->normalize($candidate_email);

        if ($candidate_email === $email) {
            return $candidate;
        }

        return false;
    }
}
