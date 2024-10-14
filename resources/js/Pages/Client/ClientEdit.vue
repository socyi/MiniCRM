<template>
    <Head title="Edit Client" />
    <AuthenticatedLayout>
        <div class="container mt-4">
            <h2>Edit Client</h2>
            <form @submit.prevent="updateClient" class="mt-5">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" v-model="client.first_name" class="form-control" id="first_name" required />
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" v-model="client.last_name" class="form-control" id="last_name" required />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" v-model="client.email" class="form-control" id="email" required />
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-success mr-3">Update</button>
                    <button type="button" class="btn btn-secondary" @click="$inertia.visit('/clients')">Cancel</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        AuthenticatedLayout,
        Head,
    },
    props: {
        client: Object,
    },
    methods: {
        updateClient() {
            this.$inertia.put(`/clients/${this.client.id}`, this.client);
        },
    },
};
</script>
