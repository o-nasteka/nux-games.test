<?php

return [
    'link_expiration_minutes' => (int) env('LINK_EXPIRATION_MINUTES', 7 * 24 * 60), // 7 days in minutes
];
