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
                </tr>
                </tbody>
            </table>

            <nav>
                <ul class="pagination">
                    <li class="page-item" :class="{ disabled: !clients.links[0].url }">
                        <a class="page-link" :href="clients.links[0].url"
                           @click.prevent="goToPage(clients.links[0].url)">
                            &laquo;
                        </a>
                    </li>
                    <li v-for="(link, index) in clients.links.slice(1, -1)" :key="index" class="page-item"
                        :class="{ active: link.active }">
                        <a class="page-link" :href="link.url" @click.prevent="goToPage(link.url)">
                            {{ link.label }}
                        </a>
                    </li>
                    <li class="page-item" :class="{ disabled: !clients.links[clients.links.length - 1].url }">
                        <a class="page-link" :href="clients.links[clients.links.length - 1].url"
                           @click.prevent="goToPage(clients.links[clients.links.length - 1].url)">
                            &raquo;
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';

export default {
    props: {
        clients: Object, // Accept pagination data as an object
    },
    components: {
        AuthenticatedLayout,
        Head,
    },
    methods: {
        goToPage(url) {
            this.$inertia.get(url); // Use Inertia to navigate to the new page
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
