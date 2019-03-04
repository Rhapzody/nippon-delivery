@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else

@if ($level == 'error')
# @lang('Whoops!')
@else
    {{"ยินดีต้อนรับท่านลูกค้าใหม่"}}
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ "กรุณายืนยันอีเมล" }} <br/>
{{ "เพื่อปลดล็อคฟังก์ชันการดำเนินการสั่งซื้อ"}}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ "ยืนยันอีเมล" }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{-- {{  }} --}}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
{{"ด้วยความนับถือ"}},<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser: ',
    [
        'actionText' => $actionText
    ]
)
[{{ $actionUrl }}]({!! $actionUrl !!})
@endcomponent
@endisset
@endcomponent
