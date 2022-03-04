<template>
    <div v-if="!fetching" class="">
        <section class="px-10 mt-5 w-full mx-auto">
            <h1 class="my-5 text-4xl font-semibold text-red-700">
                {{ data.category.name }}
            </h1>
            <div class="grid grid-cols-4 gap-6">
                <div
                v-for="(card, index) in data.category.products.data"
                :key="`product-card-${index}`"
                class="
                    shadow
                    hover:shadow-lg
                    transition
                    duration-300
                    ease-in-out
                    xl:mb-0
                    lg:mb-0
                    md:mb-0
                    mb-6
                    cursor-pointer
                    group
                "
                >
                <div class="overflow-hidden relative">
                    <img
                    class="
                        w-full
                        transition
                        duration-700
                        ease-in-out
                        group-hover:opacity-60
                    "
                    :src="card.main_image_url"
                    :alt="card.name"
                    />
                    <div class="w-full">
                    <div
                        class="
                        flex
                        justify-center
                        w-full
                        absolute
                        bottom-4
                        transition
                        duration-500
                        ease-in-out
                        opacity-0
                        group-hover:opacity-100
                        "
                    >
                        <AddToCart :slug="card.slug" />
                    </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-white">
                    <a href="#" class="">
                    <h1
                        class="
                        text-gray-800
                        font-semibold
                        text-lg
                        hover:text-red-500
                        transition
                        duration-300
                        ease-in-out
                        "
                    >
                        {{ card.name }}
                    </h1>
                    </a>
                    <div class="flex py-2">
                        <p class="text-red-600 font-bold text-2xl">
                            ${{ card.price }}
                        </p>
                    </div>
                </div>
                </div>
            </div>
            <div class="mt-5 border-t border-gray-300 flex w-full p-5">
                <Pagination 
                    @previous="previousButtonOnClick"
                    @next="nextButtonOnClick"
                    :total="data.category.products.total"
                    :per-page="data.category.products.per_page"
                    :current-page="data.category.products.current_page"
                    :from="data.category.products.from" 
                    :to="data.category.products.to" 
                    :last-page="data.category.products.last_page"
                    :has-more-pages="data.category.products.has_more_pages"
                />
            </div>
        </section>
    </div>
</template>

<script lang="ts">
import GetCategoryQuery from "@/graphql/GetCategory"
import AddToCart from "@/components/catalog/AddToCart.vue"
import { useQuery } from "@urql/vue"
import { defineComponent, ref, watch } from "vue"
import { useI18n } from "vue-i18n"
import { useRouter } from "vue-router"
import Pagination from "@/components/Pagination.vue"

export default defineComponent({
    components: {
        AddToCart,
        Pagination
    },
    setup() {
        const { t } = useI18n()
        const router = useRouter()
        const slug = ref(router.currentRoute.value.params.slug)
        const page = ref(1)

        const result = useQuery({
            query: GetCategoryQuery,
            variables: { slug: slug, page: page },
        })

        watch(router.currentRoute, (newValue) => {
            slug.value = newValue.params.slug
            
            result.executeQuery({
                variables: { slug: newValue.params.slug, page: page },
                requestPolicy: "network-only",
            })
        })
        const nextButtonOnClick = () => {
            page.value += 1
            console.log('page ' +  page.value)
            result.executeQuery({
                variables: { slug: slug, page: page },
                requestPolicy: "network-only",
            })
        }
        const previousButtonOnClick = () => {
            
            page.value -= 1
            if (page.value < 0) {
                page.value = 0
            }
            console.log('page ' +  page.value)
            result.executeQuery({
                variables: { slug: slug, page: page },
                requestPolicy: "network-only",
            })
        }
        return {
            t,
            nextButtonOnClick,
            previousButtonOnClick,
            slug,
            fetching: result.fetching,
            data: result.data,
            error: result.error,
        }
    },
});
</script>
