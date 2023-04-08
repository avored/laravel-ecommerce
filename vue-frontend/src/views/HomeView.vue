<script setup lang="ts">
import TheWelcome from '../components/TheWelcome.vue'

import { useQuery } from '@vue/apollo-composable'
import gql from 'graphql-tag'

    const { result } = useQuery(gql`
    query CategoryAllQuery{
    allCategory {
            id
            name
            slug
            description
            meta_title
            meta_description
            created_at
            updated_at
            children {
                id 
                name
                slug
                meta_title
                meta_description
                created_at
                updated_at
            }
            products {
                data {
                    id
                    name
                    price
                }
            }
    }
}
    `)
  
</script>

<template>
  <main>
    <TheWelcome />
    {{ result }}
  </main>
</template>
