<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('case.${caseId}', function ($user, $caseId) {
    return true;
});

Broadcast::routes();
