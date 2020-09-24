<template>
  <div>
    <div
      class="modal z-1 fixed w-full h-full top-0 left-0 flex items-center justify-center"
        :class="modalClass"
    >
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div
        class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto"
      >
       
        <div class="modal-content py-4 text-left px-6">
          <div class="flex justify-between items-center pb-3">
            <p v-if="modalTitle" class="text-2xl font-bold">{{ modalTitle }}</p>
            <div class="modal-close cursor-pointer z-50">
              <svg
                class="fill-current text-black"
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 18 18"
              >
                <path
                  d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
                />
              </svg>
            </div>
          </div>
          <slot />

          <div class="flex border-t my-3 pt-3 justify-end">
            <button 
              v-if="actionBtn"
              @click="$emit('actionBtnClick', $event)"
              class="px-4 bg-transparent p-3 bg-red-600 rounded-md text-white hover:bg-red-500 hover:text-white mr-2">
              {{ actionBtnText }}
            </button>
            <button
              @click="active=false"
              class="modal-close px-4  p-3 rounded-md border border-gray-400 hover:bg-red-400"
            >Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "avored-modal",
  props: {
    modalTitle: {type: [String], default: ''},
    actionBtn: {type: [Boolean], default: false},
    actionBtnText: {type: [String], default: ''},
    initActive: {type: [Boolean], default: false},
  },
  data() {
    return {
        active: false
      
    };
  },
  computed: {
    modalClass() {
      if (this.isModalActive) {
        return 'modal-active'
      } else {
        return 'opacity-0 pointer-events-none'
      }
    },
    isModalActive() {
      if (this.initActive) {
        this.active = true
      }
      return this.active
    }
  },
  methods: {
  
     
  },
  watch: {},
  mounted() {
    //  this.initActive = this.active
  }
};
</script>
<style scoped>
.modal {
    transition: opacity 0.25s ease;
  }
body.modal-active {
  overflow-x: hidden;
  overflow-y: visible !important;
}
</style>
