<template>
  <button
    @click="$emit('click', $event)"
    class="font-bold py-2 px-4 rounded inline-flex items-center"
    :class="orverrideClass"
    :type="htmlType"
  >
    <zondicon v-if="iconType" :icon="iconType" class="h-4 w-4 mr-2 fill-current" />
    <div v-if="buttonText">{{ buttonText }}</div>
  </button>
</template>
<script>
export default {
  name: "avored-button",
  props: {
    buttonText: { type: [String], default: "" },
    htmlType: { type: [String], default: "button" },
    type: { type: [String], default: "default" },
    iconType: { type: String, default: "" },
    buttonClass: { type: String, default: "" }
  },
  data() {
    return {};
  },

  computed: {
    orverrideClass() {
      if (this.type === "primary") {
        return (
          this.buttonClass +
          " bg-red-600 text-white hover:bg-red-500 hover:text-white"
        );
      }

      return this.buttonClass + "text-gray-800 text-gray-600";
    }
  },
  mounted() {}
};
</script>
