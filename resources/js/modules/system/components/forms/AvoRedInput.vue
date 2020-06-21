<template>
  <div class="">
    <label :for="fieldName" class="text-sm w-2/6 text-gray-600" :class="labelClass">{{ labelText }}</label>
    <span  class="relative block w-4/6">
        <span class="flex w-full items-center">
          <input
              :id="fieldName"
              :type="inputType"
              :autofocus="isAutoFocus"
              v-model="changeValue"
              class="px-3 py-2 w-full rounded border focus:outline-none"
              :class="extraClass"
          />
          <slot name="addOnAfter" />
        </span>
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
  name: 'avored-input',
  props: {
    labelText: { type: [String], default: '' },
    labelClass: { type: [String], default: '' },
    inputClass: { type: [String], default: '' },
    inputType: { type: [String], default: 'text' },
    initValue: { type: [String, Number], default: '' },
    fieldName: { type: [String], default: '' },
    isDisabled: { type: [Boolean], default: false },
    isAutoFocus: { type: [Boolean], default: false },
    errors: { type: [Object], dafult: () => {} },
  },
  data() {
    return {
      changeValue: this.initValue,
    };
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
  watch: {
    changeValue(newValue) {
      this.$emit('input', newValue);
    }
  },
  mounted() {
   
  }
};
</script>
