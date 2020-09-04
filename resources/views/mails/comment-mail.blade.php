@component('mail::message')

@component('mail::panel')

Dear Customer,

# AvoRed Shopping Cart Order Comment

Admin have placed an comment on your order. Please click here to open and see.
@component('mail::button', ['url' => $url])
Open Comment
@endcomponent

Thanks,
AvoRed Shopping Cart Team
@endcomponent
