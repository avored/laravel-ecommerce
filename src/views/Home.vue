<template>
  <div class="home">
    <h1 class="text-4xl text-red-600">Hello world</h1>
      <div v-if="!fetching">
          <div v-for="(category, index) in data.allCategory" :key="index">
              {{ category.name }}  
          </div> 
      </div>
  </div>
</template>

<script lang="ts">
import { useQuery } from '@urql/vue';
import { defineComponent } from 'vue'

export default defineComponent({
  props: {
    message: {
      type: String,
      required: true
    }
  },

  setup() {
    const result = useQuery({
      query: `
        {
          allCategory {
            id
            name
          }
        }
      `
    });

    return {
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  }
})
</script>
