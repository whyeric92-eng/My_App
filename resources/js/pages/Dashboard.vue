<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { dashboard } from '@/routes';
import { route as ziggyRoute } from 'ziggy-js';
import { Ziggy } from '../ziggy.js';
import DashboardUserRow from './DashboardUserRow.vue';


const route = (name: string, params?: Record<string, unknown>): string =>
    String(
        (ziggyRoute as (n: string, p?: object, abs?: boolean, c?: object) => unknown)(
            name,
            params ?? {},
            false,
            Ziggy,
        ),
    );

type User = {
    id: number;
    name: string;
    email: string;
    created_at: string;
    updated_at: string;
};



defineProps<{
    users: User[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});



</script>

<template>
    <Head title="Dashboard" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
                <div>
                    <div class="flex gap-x-2" v-for="user in users" :key="user.id">
                        <DashboardUserRow :user="user" @update="router.post('/users/update', { user_id: user.id, name: user.name })"/>
                    </div>
                </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
            >
                <PlaceholderPattern />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
            >
                <PlaceholderPattern />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
            >
                
            </div>
        </div>
        <div
            class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
        >
            <PlaceholderPattern />
        </div>
    </div>
</template>
