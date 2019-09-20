@extends('avored::layouts.app')

@section('meta_title')
    {{ __('a-banner::banner.edit.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('a-banner::banner.edit.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <banner-edit base-url="{{ asset(config('avored.admin_url')) }}" :banner="{{ $banner }}" inline-template>
        <div>
            <a-form 
                :form="form"
                method="post"
                action="{{ route('admin.banner.save', $banner->id ?? null) }}"                    
                @submit="handleSubmit"
            >
                @csrf
                

                <a-row :gutter="20">
                    <a-col :span="24">
                        <a-form-item
                            @if ($errors->has('name'))
                                validate-status="error"
                                help="{{ $errors->first('name') }}"
                            @endif
                            label="{{ __('a-banner::banner.name') }}">
                            <a-input
                                :auto-focus="true"
                                name="name"
                                v-decorator="[
                                'name',
                                {initialValue: '{{ ($banner->name) ?? '' }}' },
                                {rules: 
                                    [
                                        {   required: true, 
                                            message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                        }
                                    ]
                                }
                                ]"
                            ></a-input>
                        </a-form-item>
                    </a-col>

                </a-row>
                <a-row :gutter="20">
                    <a-col :span="12">
                        <a-form-item
                            @if ($errors->has('image'))
                                validate-status="error"
                                help="{{ $errors->first('image') }}"
                            @endif
                            label="{{ __('a-banner::banner.image') }}">
                            <a-upload 
                                name="file"
                                :default-file-list="defaultFileList"
                                :multiple="false"
                                :headers="headers"
                                action="{{ route('admin.banner.upload') }}" 
                                @change="handleUploadImageChange">
                                <a-button>
                                <a-icon type="upload"></a-icon>Click to Upload
                                </a-button>
                            </a-upload>
                        </a-form-item>
                        <input type="hidden" name="image_path" v-model="image_path" />
                    </a-col>
                    <a-col :span="12">
                        <a-form-item
                            @if ($errors->has('alt_text'))
                                validate-status="error"
                                help="{{ $errors->first('alt_text') }}"
                            @endif
                            label="{{ __('a-banner::banner.alt_text') }}">
                            <a-input
                                name="alt_text"
                                v-decorator="[
                                'alt_text',
                                {initialValue: '{{ ($banner->alt_text) ?? '' }}' },
                                {rules: 
                                    [
                                        {   required: false, 
                                            message: '{{ __('avored::validation.required', ['attribute' => 'alt text']) }}' 
                                        }
                                    ]
                                }
                                ]"
                            ></a-input>
                        </a-form-item>
                    </a-col>
                </a-row>

                <a-row :gutter="20">
                    <a-col :span="12">
                        <a-form-item
                            @if ($errors->has('url'))
                                validate-status="error"
                                help="{{ $errors->first('url') }}"
                            @endif
                            label="{{ __('a-banner::banner.url') }}">
                           <a-input
                                name="url"
                                v-decorator="[
                                'url',
                                {initialValue: '{{ ($banner->url) ?? '' }}' },
                                {rules: 
                                    [
                                        {   required: false, 
                                            message: '{{ __('avored::validation.required', ['attribute' => 'url']) }}' 
                                        }
                                    ]
                                }
                                ]"
                            ></a-input>
                        </a-form-item>
                    </a-col>
                    <a-col :span="12">
                        <a-form-item
                            @if ($errors->has('target'))
                                validate-status="error"
                                help="{{ $errors->first('target') }}"
                            @endif
                            label="{{ __('a-banner::banner.target') }}">
                            <a-select 
                                @change="targetChange"
                                v-decorator="[
                                'bannerTarget',
                                {{ ($banner->target !== '') ? "{'initialValue': '" . $banner->target . "'}," : "" }}
                                {rules:
                                    [
                                        {   required: true, 
                                            message: '{{ __('avored::validation.required', ['attribute' => 'Target']) }}' 
                                        }
                                    ]
                                }
                                ]"
                            >
                                <a-select-option value="_self">{{ __('a-banner::banner.normal') }}</a-select-option>
                                <a-select-option value="_blank">{{ __('a-banner::banner.new_tab') }}</a-select-option>
                            </a-select>
                        </a-form-item>
                        <input type="hidden" name="target" v-model="bannerTarget" />
                    </a-col>
                </a-row>
                
                <a-row :gutter="20">
                    <a-col :span="12">
                        <a-form-item
                            @if ($errors->has('status'))
                                validate-status="error"
                                help="{{ $errors->first('status') }}"
                            @endif
                            label="{{ __('a-banner::banner.status') }}">
                            <a-switch 
                                {{ (isset($banner) && $banner->status) ? 'default-checked' : '' }}
                                @change="changeStatusSwitch"></a-switch>
                        </a-form-item>
                        <input type="hidden" v-model="status" name="status" />
                    </a-col>
                    <a-col :span="12">
                        <a-form-item
                            @if ($errors->has('sort_order'))
                                validate-status="error"
                                help="{{ $errors->first('sort_order') }}"
                            @endif
                            label="{{ __('a-banner::banner.sort_order') }}">
                            <a-input
                                name="sort_order"
                                v-decorator="[
                                'sort_order',
                                {initialValue: '{{ ($banner->sort_order) ?? '' }}' },
                                {rules: 
                                    [
                                        {   required: true, 
                                            message: '{{ __('avored::validation.required', ['attribute' => 'sort order']) }}' 
                                        }
                                    ]
                                }
                                ]"
                            ></a-input>
                        </a-form-item>
                    </a-col>

                </a-row>
                
                <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                    >
                        {{ __('avored::system.btn.save') }}
                    </a-button>
                    
                    <a-button
                        class="ml-1"
                        type="default"
                        v-on:click.prevent="clickCancelButton"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </banner-edit>
    </a-col>
</a-row>
@endsection

@push('scripts')
<script src="{{ asset('avored-admin/js/banner.js') }}"></script>
@endpush
