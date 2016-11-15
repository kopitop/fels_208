@if(!$user->avatar)
    <td><img src="{{ asset(config('fels.default-avatar')) }}" class="avatar" alt=""></td>
@else
    <td><img src="{{ asset($user->avatar_url) }}" class="avatar"></td>
@endif

<p>{{ $user->name }}</p>