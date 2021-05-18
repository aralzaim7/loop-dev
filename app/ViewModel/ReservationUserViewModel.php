<?php


namespace App\ViewModel;


use App\Models\ReservationCategory;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ReservationUserViewModel
{

    public function present(LengthAwarePaginator $users): array
    {
        return [
            'users' => $this->formatUser($users),
        ];
    }

    private function formatUser(LengthAwarePaginator $users)
    {
        $userCollection = $users->getCollection()
            ->map(function ($user) {
            return [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'user_info' => "<span> {$user->email} <br/> {$user->phone}</span>",
                'email' => $user->email,
                'phone' => $user->phone,
                'created_date' => $user->created_at->diffForHumans(),
            ];
        });

        return ($users->setCollection($userCollection));
    }
}

