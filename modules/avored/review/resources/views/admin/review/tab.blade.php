<a-card class="mt-1 mb-1" title="{{ __('a-review::review.review-list') }}">
    @php 
        //$reviews = ;
    @endphp
    <a-row type="flex" justify="center">
        <a-col :span="24">
        <catalog-review inline-template :reviews="{{ $reviews }}" base-url="{{ asset(config('avored.admin_url')) }}">
                <a-table :columns="columns" row-key="id" :data-source="reviews" @change="handleTableChange">
                    <span slot="action" slot-scope="text, record">
                        <a-tag color="#E64448" v-if="record.status === 'PENDING'" @click.prevent="clickOnApproved(record, $event)" :href="getApprovedUrl(record)">
                            {{ __('Click to Approve') }}
                        </a-tag>

                        <a-tag v-if="record.status === 'APPROVED'">
                            {{ __('Approved') }}
                        </a-tag>
                       
                    </span>
                </a-table>
            </catalog-review>    
        </a-col>
    </a-row>

</a-card>
@push('scripts')
<script src="{{ asset('avored-admin/js/review.js') }}"></script>
@endpush
