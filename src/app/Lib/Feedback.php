<?php

namespace App\Lib;

class Feedback
{
    public static function notification(
        string $message,
        string $subMessage = '',
        string $style = 'success',
    ): void {
        $notifications = [];
        if (session()->has('flash')) {
            $notifications = session()->pull('flash');
        }

        $notifications[] = self::notificationData(
            $message,
            $subMessage,
            $style,
        );

        session()->flash('flash', $notifications);
    }

    public static function notificationData(
        string $message,
        string $subMessage = '',
        string $style = 'success',
    ): array
    {
        return [
            'type' => 'notification',
            'message' => __($message),
            'subMessage' => __($subMessage),
            'style' => $style,
        ];
    }
}
