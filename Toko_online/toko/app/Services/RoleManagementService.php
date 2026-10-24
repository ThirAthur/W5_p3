<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class RoleManagementService
{
    public function changeRole(User $actor, User $target, string $newRole): void
    {
        if ($actor->is($target) || $target->role === 'admin') {
            throw ValidationException::withMessages([
                'role' => 'Akun sendiri atau akun admin tidak dapat diubah melalui fitur ini.',
            ]);
        }

        if ($target->role === $newRole) {
            return; // No save, sehingga tidak ada event updated.
        }

        $target->role = $newRole;
        $target->save();
    }
}
