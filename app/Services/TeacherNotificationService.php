<?php

namespace App\Services;

use App\Models\Teacher;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherNotificationMail;
use Illuminate\Support\Facades\Cache;

class TeacherNotificationService
{
    const NOTIFICATION_DELAY = 300; // 5 minutes in seconds

    public function handleModification(Teacher $teacher)
    {
        $teacherId = $teacher->id;
        $cacheKey = "teacher_notification_{$teacherId}";

        // If we already have a pending notification, update its timestamp
        Cache::put($cacheKey, $teacher, self::NOTIFICATION_DELAY);

        // Schedule the notification
        if (!Cache::has("notification_scheduled_{$teacherId}")) {
            Cache::put("notification_scheduled_{$teacherId}", true, self::NOTIFICATION_DELAY);
            $this->sendNotification($teacher);
        }
    }

    protected function sendNotification(Teacher $teacher)
    {
        if ($teacher->user && $teacher->user->email) {
            Mail::to($teacher->user->email)->send(new TeacherNotificationMail($teacher));
        }
    }
}
