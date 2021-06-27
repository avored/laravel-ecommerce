<h4 class="text-lg text-red-700 font-semibold my-5">{{ __('avored.user_personal_info') }}</h4>
@guest('customer')
    <div class="flex items-center">
        <div class="w-1/2">
            <div class="mt-3 flex w-full">
                <avored-input
                    label-text="{{ __('avored.first_name') }}"
                    field-name="first_name"
                    error-text="{{ $errors->first('first_name') }}"
                >
                </avored-input>
            </div>
        </div>
        <div class="w-1/2 ml-3">
            <div class="mt-3 flex w-full">
                <avored-input
                    label-text="{{ __('avored.last_name') }}"
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
                label-text="{{ __('avored.email') }}"
                field-name="email"
                error-text="{{ $errors->first('email') }}"
            >
            </avored-input>
        </div>
    </div>

    <div class="flex items-center" v-if="newAccount">
        <div class="w-1/2">
            <avored-input
                label-text="{{ __('avored.password') }}"
                field-name="password"
                input-type="password"
                error-text="{{ $errors->first('password') }}"
            >
            </avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('avored.password_confirmation') }}"
                field-name="password_confirmation"
                input-type="password"
                error-text="{{ $errors->first('password_confirmation') }}"
            ></avored-input>
        </div>
    </div>
@else
    <div class="flex">
        <div class="w-full">
            <div class="border shadow rounded">
                <div class="p-5 border-b">
                    {{ auth()->guard('customer')->user()->full_name }}
                </div>
            </div>
        </div>
    </div>
@endGuest
