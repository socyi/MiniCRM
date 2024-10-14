<template>
    <Head title="Create Client" />
    <AuthenticatedLayout>
        <div class="container mt-4">
            <h2>Create Client</h2>
            <form @submit.prevent="createClient" enctype="multipart/form-data">
                <div class="form-group mt-5">
                    <label for="first_name">First Name</label>
                    <input type="text" v-model="form.first_name" class="form-control" id="first_name" required />
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" v-model="form.last_name" class="form-control" id="last_name" required />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" v-model="form.email" class="form-control" id="email" required />
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" @change="handleFileUpload" class="form-control" id="avatar" accept="image/*" />
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary mr-3">Create Client</button>
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
    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                avatar: null,
            },
        };
    },
    methods: {
        handleFileUpload(event) {

            this.form.avatar = event.target.files[0];
        },
        createClient() {
            const formData = new FormData();
            formData.append('first_name', this.form.first_name);
            formData.append('last_name', this.form.last_name);
            formData.append('email', this.form.email);
            if (this.form.avatar) {
                formData.append('avatar', this.form.avatar);
            }

            this.$inertia.post('/clients', formData);
        },
    },
};
</script>
