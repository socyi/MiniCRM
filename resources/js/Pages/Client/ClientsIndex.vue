<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Clients
            </h2>
        </template>

        <div class="container mt-4">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(client, index) in clients.data" :key="client.id">
                    <td>{{ index + 1 + (clients.current_page - 1) * clients.per_page }}</td>
                    <td>{{ client.first_name }}</td>
                    <td>{{ client.last_name }}</td>
                    <td>{{ client.email }}</td>
                    <td>
                        <img v-if="client.avatar" :src="`/storage/${client.avatar}`" alt="Avatar" class="avatar" />
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" @click="viewClient(client.id)">View</button>
                        <button class="btn btn-warning btn-sm" @click="editClient(client.id)">Edit</button>
                        <button class="btn btn-danger btn-sm" @click="deleteClient(client.id)">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>

            <button class="btn btn-primary float-right" @click="createClient">Create Client</button>

            <nav>
                <ul class="pagination">
                    <li class="page-item" :class="{ disabled: !clients.links[0].url }">
                        <a class="page-link" :href="clients.links[0].url" @click.prevent="goToPage(clients.links[0].url)">
                            &laquo;
                        </a>
                    </li>
                    <li v-for="(link, index) in clients.links.slice(1, -1)" :key="index" class="page-item" :class="{ active: link.active }">
                        <a class="page-link" :href="link.url" @click.prevent="goToPage(link.url)">
                            {{ link.label }}
                        </a>
                    </li>
                    <li class="page-item" :class="{ disabled: !clients.links[clients.links.length - 1].url }">
                        <a class="page-link" :href="clients.links[clients.links.length - 1].url" @click.prevent="goToPage(clients.links[clients.links.length - 1].url)">
                            &raquo;
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <br>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
    props: {
        clients: Object,
    },
    components: {
        AuthenticatedLayout,
        Head,
    },
    methods: {
        goToPage(url) {
            this.$inertia.get(url);
        },
        viewClient(id) {
            this.$inertia.get(`/clients/${id}`);
        },
        editClient(id) {
            this.$inertia.get(`/clients/${id}/edit`);
        },
        deleteClient(id) {
            if (confirm('Are you sure you want to delete this client?')) {
                this.$inertia.delete(`/clients/${id}`);
            }
        },
        createClient() {
            this.$inertia.get('/clients/create');
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
