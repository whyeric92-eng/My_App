<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import { Button } from '@/components/ui/button';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { dashboard } from '@/routes';
import DashboardUserRow from './DashboardUserRow.vue';

const importForm = useForm<{ file: File | null }>({
    file: null,
});

function onFileChange(event: Event): void {
    const input = event.target as HTMLInputElement;
    importForm.file = input.files?.[0] ?? null;
}

function submitImport(): void {
    importForm.post('/users/import', {
        forceFormData: true,
        onError: (errors) => {
            for (const msg of Object.values(errors)) {
                toast.error(String(msg));
            }
        },
    });
}

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
                        <DashboardUserRow :user="user" @update="router.post('/users/update', { user_id: user.id, name: user.name }, { onError: (errors) => { for (const msg of Object.values(errors)) toast.error(String(msg)); } })"/>
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
                class="relative flex aspect-video flex-col justify-center gap-3 overflow-hidden rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border"
            >
                <p class="text-sm font-medium">导入用户</p>
                <p class="text-xs text-muted-foreground">
                    CSV / Excel，三列：姓名、邮箱、密码（无表头）
                </p>
                <input
                    type="file"
                    accept=".csv,.xlsx,.xls"
                    class="text-xs"
                    @change="onFileChange"
                />
                <Button
                    size="sm"
                    :disabled="!importForm.file || importForm.processing"
                    @click="submitImport"
                >
                    {{ importForm.processing ? '导入中…' : '上传并导入' }}
                </Button>
            </div>
        </div>
        <div
            class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
        >
            <PlaceholderPattern />
        </div>
    </div>
</template>
