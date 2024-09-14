<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Email
{
    public static function getValidEmails($email)
    {
        $emails = explode(';', $email);
        $validEmails = [];

        foreach ($emails as $email) {
            if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = trim($email);
            }
        }

        return $validEmails;
    }

    public static function sendEmailToAdmin($subject, $details)
    {
        $email = __('string.email_administrativ');

        $validEmails = self::getValidEmails($email);
        Log::info($details);
        if (!empty($validEmails)) {
            Mail::send(
                'admin.email.form',
                [
                    'details' => $details,
                    'subject' => $subject,
                ],
                function ($message) use ($validEmails, $subject) {
                    $message->subject($subject);
                    $message->from(env('MAIL_FROM_ADDRESS'));
                    $message->to($validEmails[0]);
                    for ($i = 1; $i < count($validEmails); $i++) {
                        $message->cc($validEmails[$i]);
                    }
                }
            );
        }
    }
}
