<template>
  <div class="home">
    <h1 class="text-2xl text-red-600">Hello world</h1>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';

@Options({
  components: {
  },
})
export default class Home extends Vue {}
</script>
