<template>
<div class="">
    <label :for="fieldName" class="text-sm w-2/6 text-gray-600" :class="labelClass">{{ labelText }}</label>
    <span  class="relative block w-4/6">
        <div @click="toggleChange" class="w-full flex items-center mt-2">
            <span role="checkbox" tabindex="0" aria-checked="false" 
                class="relative inline-block flex-shrink-0 h-4 w-12 
                    rounded-full border border-2 cursor-pointer transition-colors ease-in-out duration-200 
                    outline-none"
                :class="toggleBgClass">
                <!-- On: "translate-x-5", Off: "translate-x-0" -->
                <span class="translate-x-0 inline-block -mt-1 h-6 w-6 rounded-full bg-white shadow transform transition ease-in-out duration-200"
                    :class="toggleTransitionClass">

                </span>
            </span>
        </div>
        <input type="hidden" :name="fieldName" v-model="changeValue" />
        <p class="text-xs italic text-red-400 absolute block"  v-if="hasError">
            {{ errorText }}
        </p>
    </span>
  </div>

</template>
<script>
import has from 'lodash/has'
import get from 'lodash/get'

export default {
    name: 'avored-toggle',
    props: {
        labelText: { type: [String], default: ''},
        labelClass: { type: [String], default: ''},
        inputClass: { type: [String], default: ''},
        initValue: { type: [String, Number, Boolean], default: ''},
        errors: { type: [Object], default: {} },
        fieldName: { type: [String], default: ''},
        toggleOnValue: { type: [String, Number], default: 1},
        toggleOffValue: { type: [String, Number], default: 0},
    },
    computed: {
    hasError() {
      return has(this.errors, this.fieldName + '.0')
    },
    errorText() {
      return get(this.errors, this.fieldName + '.0')
    },
    
  },
    data() {
        return {
            changeValue: this.initValue,
            toggle: false,
            toggleTransitionClass: 'translate-x-0',
            toggleBgClass: 'bg-gray-200'
        }
    },
    methods: {
        toggleChange() {
            if (this.toggle) {
                this.toggle = false
                this.changeValue = this.toggleOffValue
                this.toggleBgClass = 'bg-gray-200'
                this.toggleTransitionClass = 'translate-x-0'
            } else if (!this.toggle) {
                this.toggle = true
                this.changeValue = this.toggleOnValue
                this.toggleBgClass = 'bg-red-600'
                this.toggleTransitionClass = 'translate-x-6'
            }
        }
    },
    watch: {
        changeValue(newValue) {
            this.$emit('input', newValue)
        }
    },
    mounted() {
        if (this.errorText) {
            this.inputClass += ' border-red-500'
        }
        if (this.toggleOnValue == this.initValue) {
            this.toggle = true
            this.changeValue = this.toggleOnValue
            this.toggleBgClass = 'bg-red-600'
            this.toggleTransitionClass = 'translate-x-6'
        }
    }
}
</script>
