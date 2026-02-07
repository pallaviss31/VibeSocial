<?php

namespace App\Policies;

use App\Models\StudyGroup;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudyGroupPolicy
{

    public function makeAdmin(User $authUser, StudyGroup $group, User $target): bool
    {
        return $group->created_by === $authUser->id
            && $target->id !== $authUser->id;
    }

    /**
     * Only creator can remove admin
     */
    public function removeAdmin(User $authUser, StudyGroup $group, User $target): bool
    {
        return $group->created_by === $authUser->id
            && $target->id !== $authUser->id;
    }

    /**
     * Only creator can remove members
     */
    public function manageMembers(User $authUser, StudyGroup $group, User $target): bool
    {
        return $group->created_by === $authUser->id
            && $target->id !== $authUser->id;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StudyGroup $studyGroup): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StudyGroup $studyGroup): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StudyGroup $studyGroup): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StudyGroup $studyGroup): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StudyGroup $studyGroup): bool
    {
        return false;
    }
}
