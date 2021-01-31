<div>
    <div class="mt-5 rounded border">
        <div class="text-semibold p-3 border-b text-red-700 text-2xl">
            {{ __('avored-review::review.title') }}
        </div>
        <div class="p-5">
            <div class="block w-full">
                <div class="flex items-center mb-5 w-full rounded">
                    <div class="w-32 h-32">
                        <img src="https://placehold.it/250x250" class="w-full h-full" />
                    </div>

                    <div class="mx-3 pt-3 inline-block">
                        <div class="text-red-700 font-semibold">User Name</div>
                        <div class="text-xs">1 day ago</div>
                    </div>
                    <div class="mx-5 py-3 flex-1">
                        <div class="flex">
                            <svg class="w-6 h-6 text-orange-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            <svg class="w-6 h-6 text-orange-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            <svg class="w-6 h-6 text-orange-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            <svg class="w-6 h-6 text-orange-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            <svg class="w-6 h-6 text-orange-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of leap
                        </p>
                    </div>
                </div>
            </div>          
        </div>
    </div>

    <div class="mt-5 rounded border">
        <div class="text-semibold p-3 border-b text-red-700 text-2xl">
            {{ __('avored-review::review.create_review') }}
        </div>
        <div class="p-5">
            <avored-review-save inline-template>
                <div class="block w-full">
                    <div class="block w-full rounded">
                        <form action="{{ route('review.save') }}" method="post"> 
                            @csrf
                            <label class="w-full text-gray-600 text-sm mb-3 pl-1 block">
                                {{ __('avored-review::review.rating') }}
                                <input type="hidden" name="star" v-model="givenRating" />
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            </label>
                            <div class="flex">
                                <svg 
                                    @mouseover="onStarOver(1)" 
                                    @mouseleave="onStarLeave"
                                    @click="clickOnStar(1)"
                                    :class="(givenRating >= 1 | star>=1) ? 'text-orange-500' : ''" 
                                    class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                <svg
                                    @mouseover="onStarOver(2)" 
                                    @mouseleave="onStarLeave"
                                    @click="clickOnStar(2)"
                                    :class="(givenRating >= 2 | star>=2) ? 'text-orange-500' : ''"
                                    class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                <svg 
                                    @mouseover="onStarOver(3)" 
                                    @mouseleave="onStarLeave"
                                    @click="clickOnStar(3)"
                                    :class="(givenRating >= 3 | star>=3) ? 'text-orange-500' : ''" 
                                    class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                <svg 
                                    @mouseover="onStarOver(4)" 
                                    @mouseleave="onStarLeave"
                                    @click="clickOnStar(4)"
                                    :class="(givenRating >= 4 | star>=4) ? 'text-orange-500' : ''" 
                                    class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                <svg 
                                    @mouseover="onStarOver(5)" 
                                    @mouseleave="onStarLeave"
                                    @click="clickOnStar(5)"
                                    :class="(givenRating >= 5 | star>=5) ? 'text-orange-500' : ''" 
                                    class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>

                            @if(!Auth::guard('customer')->check())
                                
                                <div class="w-full mt-5 block">
                                    <avored-input 
                                        field-name="name"
                                        label-text="{{ __('avored-review::review.name') }}"
                                    ></avored-input>
                                </div>
                                <div class="w-full mt-5 block">
                                    <avored-input 
                                        field-name="email"
                                        label-text="{{ __('avored-review::review.email') }}"
                                    ></avored-input>
                                </div>
                            @endif
                            <div class="w-full mt-5 block">
                                <label for="content" class="text-gray-500 text-sm">{{ __('avored-review::review.content') }}</label>
                                <textarea id="content" name="content" class="border p-3 rounded block w-full"></textarea>
                            </div>

                            <div class="mt-3 py-3">
                                <button type="submit"
                                    class="px-4 py-2 font-semibold leading-7  text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
                                >   
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 inline-flex w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/>
                                    </svg>
                                    <span class="ml-3">{{ __('avored::system.btn.save') }}</span>
                                </button>
                                
                                <a href="{{ route('admin.page.index') }}"
                                    class="px-4 py-2 font-semibold inline-block text-white leading-7 hover:text-white bg-gray-500 rounded hover:bg-gray-600">
                                    <span class="leading-7">
                                        {{ __('avored::system.btn.cancel') }}
                                    </span>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>          
            </avored-review-save>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ route('admin.script', 'avored.review.js') }}"></script>
@endpush
