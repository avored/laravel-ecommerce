<template>
    <div class="relative inset-0" @click="isVisible = false">
        <div class="relative inline-block" @mouseover="isVisible = true" @mouseleave="isVisible = false" @keydown.enter="isVisible = !isVisible">
            <slot />
            <transition enter-active-class="transition duration-300 ease-out transform" enter-class="-translate-y-3 scale-95 opacity-0" enter-to-class="translate-y-0 scale-100 opacity-100" leave-active-class="transition duration-150 ease-in transform" leave-class="translate-y-0 opacity-100" leave-to-class="-translate-y-3 opacity-0">
                <div v-show="isVisible" class="absolute w-full pt-2">
                    <slot name="dropdown-content" />
                </div>
            </transition>
        </div>
    </div>
</template>
<script>
export default {
    props: [],
    data() {
        return {
           isVisible: false
        }
    },
    methods: {
            },
    mounted() {
        
        
    }
}
</script>
