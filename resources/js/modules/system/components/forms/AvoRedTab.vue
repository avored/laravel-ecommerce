<template>
    <section v-show="isActive"
             :aria-hidden="! isActive"
             :id="identifier"
             role="tabpanel"
    >
        <slot />
    </section>
</template>

<script>
    export default {
        props: {
            identifier: { type: [String] },
            name: { type: [String] },
        },
        data: () => ({
            isActive: false,
            isVisible: true,
        }),
        computed: {
           
        },
    };
</script>
