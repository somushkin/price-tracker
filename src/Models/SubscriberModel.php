<?php

namespace App\Models;

class SubscriberModel extends AbstractModel
{
    public static string $table = 'subscribers';

    private ?string $email = null;
    private ?bool $is_verified = null;
    private ?string $verification_code = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
        $this->modifiedFields['email'] = $email;
    }

    public function isVerified(): bool
    {
        return (bool)$this->is_verified;
    }

    public function verify(): void
    {
        $this->modifiedFields['is_verified'] = 1;
        $this->is_verified = true;
    }

    public function setIsVerified(bool $is_verified): void
    {
        $this->is_verified = $is_verified;
        $this->modifiedFields['is_verified'] = (int)$is_verified;
    }

    public function setVerificationCode($code): void
    {
        $this->modifiedFields['verification_code'] = $code;
        $this->verification_code = $code;
    }
}