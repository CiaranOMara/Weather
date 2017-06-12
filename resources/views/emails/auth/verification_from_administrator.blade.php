@component('mail::message')
    ## Dear {{title_case($name)}},

    You are receiving this email because and administrator at {{ config('app.name') }} has created an account for you.
    {{ config('app.name') }} requires you to verify your email address to ensure that set notifications can be received.

    Please click the "{{ $actionText }}" button to verify your email address.

    @component('mail::button', ['url' => $actionUrl, 'color' => 'green'])
        {{ $actionText }}
    @endcomponent

    Regards,<br>
    {{ config('app.name') }}

    @component('mail::subcopy')
        If you’re having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below
        into your web browser: [{{ $actionUrl }}]({{ $actionUrl }})
    @endcomponent

@endcomponent
