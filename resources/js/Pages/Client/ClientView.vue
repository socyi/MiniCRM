<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Client Details
            </h2>
        </template>

        <div class="container mt-5">

            <div v-if="client">
                <div class="d-flex align-items-center mb-4">
                    <p class="mb-me-2"><strong>Avatar:</strong></p>
                    <img v-if="client.avatar" :src="`/storage/${client.avatar}`" alt="Avatar" class="avatar me-3 ml-4" />
                </div>

                <p><strong>First Name:</strong> {{ client.first_name }}</p>
                <p><strong>Last Name:</strong> {{ client.last_name }}</p>
                <p><strong>Email:</strong> {{ client.email }}</p>

                <button class="btn btn-secondary mb-3 mt-3" @click="goBack">Back</button>
            </div>
            <div v-else>
                <p>Loading...</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    props: {
        client: Object,
    },
    components: {
        AuthenticatedLayout,
    },
    methods: {
        goBack() {
            this.$inertia.visit('/clients');
        },
    },
};
</script>

<style>
.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
</style>
