<?php

namespace App\Services\Interfaces;

interface IMailer
{
    public static function mail(string $email, string $subject, string $message): void;
}