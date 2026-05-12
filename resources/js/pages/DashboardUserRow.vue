<script setup lang="ts">
type User = {
    id: number;
    name: string;
    email: string;
    created_at: string;
    updated_at: string;
};
const props= defineProps<{
    user: User;
}>();
const emit=defineEmits(['update'])
</script>
<template>
    <div class="flex gap-x-2">
        <button @click="emit('update')">Update</button>
    <input v-model="user.name" type="text" id="first_name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="username" required />
    </div>
    <input v-model="user.email" type="text" id="first_name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="user email" required />
    <div>{{ user.created_at }}</div>
    <div>{{ user.updated_at }}</div>
</template>