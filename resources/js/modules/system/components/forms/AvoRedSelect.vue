<template>
    <div>
        <div class="">
            <label :for="fieldName" class="text-sm w-2/6 text-gray-600" :class="labelClass">{{ labelText }}</label>
            <span  class="relative block w-4/6">
                <button
                    type="button"
                    @click="dropdownToggle=!dropdownToggle"
                    class="border flex w-full border-gray-400 py-2 px-4 rounded"
                >
                
                    <span class="flex-1 text-left">{{ displayText }}</span>
                    <span class="ml-auto">
                        <svg
                            class="fill-current text-gray-400 h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                            />
                        </svg>
                    </span>
                </button>
                <ul @click="selectedOption" v-if="dropdownToggle" 
                    class="dropdown-options w-full mt-1 z-10 bg-white border border-gray-500 absolute overflow-y-scroll rounded shadow text-gray-700">
                    
                    <template v-for="(option, index) in options">
                        <li :key="index" :value="option.value"
                            class="px-2 py-1 hover:bg-gray-300 cursor-pointer">
                            {{ option.label }}
                        </li>
                    </template>
                </ul>
                <p class="text-xs italic text-red-400 absolute block"  v-if="hasError">
                    {{ errorText }}
                </p>
            </span>
        </div>
        
    </div>
</template>
<script>
import has from 'lodash/has'
import get from 'lodash/get'
import vClickOutside from 'v-click-outside'

export default {
    name: "avored-select",
    components: {
    
    },
    directives: {
        clickOutside: vClickOutside.directive
    },
    props: {
        labelClass: { type: [String], default: "" },
        labelText: { type: [String], default: "" },
        initValue: { type: [String, Number], default: "" },
        options: {type: [Array, Object], default: () =>[]},
        errors: { type: [Object], default: {} },
        fieldName: { type: [String], default: ''}
    },
    data() {
        return {
            changeValue: this.initValue,
            displayText: '',
            dropdownToggle: false
        };
    },
    methods: {
        selectedOption(event) {
            this.changeValue = event.target.getAttribute('value')
            const index = this.options.findIndex((ele) => ele.value === this.changeValue)
            this.displayText = this.options[index].label ?? ''
            this.dropdownToggle = !this.dropdownToggle
            this.$emit('change', this.changeValue)
        }
    },
    watch: {
        changeValue(newValue) {
            this.$emit("input", newValue);
        }
    },
    computed: {
        hasError() {
            return has(this.errors, this.fieldName + '.0')
        },
        errorText() {
            return get(this.errors, this.fieldName + '.0')
        },
        extraClass() {
            if (has(this.errors, this.fieldName + '.0')) {
                return ' border-red-400 focus:border-red-400'
            } else {
                return ' border-gray-400 focus:border-blue-300'
            }
        }
    },
    mounted() {
      
        if (this.initValue) {
            const index = this.options.findIndex((ele) => ele.value == this.initValue)
            this.displayText = get(this.options, index + '.label')
        }
    }
};
</script>
<style scoped>
.dropdown-options {
    max-height: 9rem;
}
</style>
