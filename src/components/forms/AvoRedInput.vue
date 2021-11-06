<template>
  <div>
    <label v-if="fieldLabel" class="text-sm text-gray-700">
      {{ fieldLabel }}
    </label>
    <input
        ref="input"
        :name="fieldName"
        :type="fieldType"
        class="avored-input"
        :value="value"
        @change="change"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    fieldLabel: {
      type: String,
      default: "",
      required: false,
    },
    fieldName: {
      type: String,
      default: "",
      required: true,
    },
    fieldType: {
      type: String,
      default: "text",
      required: false,
    },
    modelValue: {
      default: '',
      required: false,
    },
  },
  emits: ["update:modelValue"],
  data() {
    return {
      value: NaN,
    };
  },
  watch: {
    modelValue: {
      immediate: true,
      handler(newValue) {
          this.setValue(newValue);
      },
    },
  },
  methods: {
    change(event: any) {
      this.setValue(event.target.value);
    },
    setValue(value: number) {
      const oldValue = this.value;
      let newValue = value;
    
      this.value = newValue;
      if (newValue === oldValue) {
        (this.$refs.input as HTMLInputElement).value = String(newValue);
      }
      this.$emit('update:modelValue', newValue, oldValue);
    },
  },
});
</script>