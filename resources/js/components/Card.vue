<template>
    <Card class="greeter flex flex-col justify-center">
        <section :class="{ dark: dark }" aria-labelledby="greeter">
            <div :class="card.style_override ?? [card.style_extend]">
                <h2 class="sr-only" id="greeter">{{ __('Greetings Overview') }}</h2>
                <div class="p-6">
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <div class="sm:flex sm:space-x-5">
                            <div v-if="card.avatar" class="flex-shrink-0">
                                <img class="mx-auto h-20 w-20 rounded-full" :src="card.avatar_url" :alt="card.user_name"/>
                            </div>
                            <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{
                                        card.message ?? __('Welcome back,')
                                    }}</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-gray-300 sm:text-2xl">{{
                                        card.user_name
                                    }}</p>
                                <p v-if="card.user_title" class="text-sm font-medium text-gray-600 dark:text-gray-400">{{
                                        card.user_title
                                    }}</p>
                                <dl v-if="card.verified"
                                    class="mt-6 flex flex-col sm:mt-1 sm:flex-row sm:flex-wrap">
                                    <dt class="sr-only">{{ card.verified_text ?? __('Verified Account') }}</dt>
                                    <dd class="mt-3 flex justify-center text-sm text-gray-500 dark:text-gray-300 font-medium sm:mr-6 sm:mt-1 capitalize">
                                        <CheckCircleIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400 dark:text-green-500"
                                                         aria-hidden="true"/>
                                        {{ card.verified_text ?? __('Verified Account') }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div
                            v-if="card.button"
                            class="mt-5 flex justify-center sm:mt-0 ml-1">
                            <Link :href="card.button_target"
                                  :class="card.button_style ?? 'flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-800 shadow-sm dark:shadow-inner text-sm font-medium whitespace-nowrap rounded-md text-gray-700 dark:text-gray-300 bg-white hover:bg-gray-50 dark:bg-gray-700 hover:dark:bg-gray-600'">
                                {{ card.button_name }}
                            </Link>
                        </div>
                    </div>
                </div>
                <div v-if="card.stats"
                     class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/25 grid grid-cols-1 divide-y divide-gray-200 dark:divide-gray-700 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                    <div v-for="stat in card.stats" :key="stat.label"
                         class="px-6 py-3 text-sm font-medium text-center">
                        <span class="text-gray-900 dark:text-gray-300">{{ stat.value }}</span>
                        {{ ' ' }}
                        <span class="text-gray-600 dark:text-gray-400">{{ stat.label }}</span>
                    </div>
                </div>
            </div>
        </section>
    </Card>
</template>

<script setup>
import CheckCircleIcon from './icons/CheckCircleIcon.vue'
import {onMounted, onBeforeUnmount, ref} from 'vue'
import {useLocalization} from 'laravel-nova'

const {__} = useLocalization()

defineProps({
    card: Object
})

const observer = ref(null)
const dark = ref(false)

onMounted(() => {
    dark.value = document.documentElement.classList.contains('dark')

    observer.value = new MutationObserver((records) => {
        records.forEach((record) => {
            dark.value = record.target.classList.contains('dark')
        })
    })

    observer.value.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class'],
        childList: false,
        characterData: false,
    })
})

onBeforeUnmount(() => {
    observer.value.disconnect()
    observer.value = null
})
</script>