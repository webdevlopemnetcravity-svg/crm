<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Immigration;

class ImmigrationPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Immigration $i): bool { return true; }
    public function create(User $user): bool { return true; }
    public function update(User $user, Immigration $i): bool { return true; }
    public function delete(User $user, Immigration $i): bool { return true; }
}
