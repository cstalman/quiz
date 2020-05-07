<?php

namespace App\Policies;

use App\Quiz;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can manage quizzes.
     *
     * @param  \App\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function manage(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function update(User $user, Quiz $quiz)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function delete(User $user, Quiz $quiz)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function restore(User $user, Quiz $quiz)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function forceDelete(User $user, Quiz $quiz)
    {
        //
    }
}
