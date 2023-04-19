<section class="bg-white shadow-md">
    <div class="container mx-auto">
        <nav class="justify-between">
            <div class="py-4 flex w-full items-center">

                <a href="#" class="flex items-center">
                    <img class="w-10" src="{{ asset('vendor/avored/images/logo_only.svg') }}" alt="{{ __('system.avored_ecommerce') }}" />
                    <span class="text-2xl ml-3 text-red-700">
                        {{ __('system.avored') }}
                    </span>
                </a>
                <ul class="hidden ml-auto md:flex space-x-6">
                    @foreach ($categories as $category)
                        <li>
                            <a href="#" class="self-center hover:text-red-500">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</section>
