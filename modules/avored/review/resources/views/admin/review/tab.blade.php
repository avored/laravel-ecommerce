<div>
    <div class="mb-5 text-red-700 font-semibold text-2xl">
        {{ __('avored-review::review.review-list') }}
    </div>
    <catalog-avored-review
        base-url="{{ asset(config('avored.admin_url')) }}"
        :init-reviews="{{ json_encode($reviews) }}"></catawlog-avored-review>
</div>
@push('scripts')
    <script src="{{ route('admin.script', 'avored.admin.review.js') }}"></script>
@endpush
