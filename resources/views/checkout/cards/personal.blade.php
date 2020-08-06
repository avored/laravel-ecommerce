<h4 class="text-lg text-red-700 font-semibold my-5">{{ __('User Personal Information') }}</h4>
@guest()
<div class="flex items-center">
    <div class="w-1/2">
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('First Name') }}"
                field-name="first_name"
                error-text="{{ $errors->first('first_name') }}"
            >
            </avored-input>
        </div>
    </div>
    <div class="w-1/2 ml-3">
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('Last Name') }}"
                field-name="last_name"
                error-text="{{ $errors->first('last_name') }}"
            >
            </avored-input>
        </div>
    </div>
   
</div>

<div class="flex items-center">
    <div class="w-full">
        <avored-input
            label-text="{{ __('Email') }}"
            field-name="email"
            error-text="{{ $errors->first('email') }}"
        >
        </avored-input>
    </div>
</div>



<div class="flex items-center" v-if="newAccount">
    <div class="w-1/2">
        <avored-input
            label-text="{{ __('Password') }}"
            field-name="password"
            input-type="password"
            error-text="{{ $errors->first('password') }}"
        >
        </avored-input>
    </div>
    <div class="w-1/2 ml-3">
        <avored-input
            label-text="{{ __('Confirm Password') }}"
            field-name="password_confirmation"
            input-type="password"
            error-text="{{ $errors->first('password_confirmation') }}"
        ></avored-input>
    </div>
    
</div>
@else

<div class="flex">
    <div>
        <div class="border shadow rounded">
            <div class="p-5 border-b">
                {{ Auth()->user()->name }}
            </div>
        </div>
    </div>
</div>
@endGuest
