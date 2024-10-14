<template>
    <Head title="Transactions" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Transactions</h2>
        </template>

        <div class="container mt-4">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Transaction Date</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(transaction, index) in transactions.data" :key="transaction.id">
                    <td>{{ index + 1 + (transactions.current_page - 1) * transactions.per_page }}</td>
                    <td>{{ transaction.client.first_name }} {{ transaction.client.last_name }}</td>
                    <td>{{ formatDate(transaction.transaction_date) }}</td>
                    <td>{{ formatAmount(transaction.amount) }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" @click="viewTransaction(transaction.id)">View</button>
                        <button class="btn btn-warning btn-sm" @click="editTransaction(transaction.id)">Edit</button>
                        <button class="btn btn-danger btn-sm" @click="deleteTransaction(transaction.id)">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>

            <button class="btn btn-primary float-right" @click="createTransaction">Create Transaction</button>

            <nav>
                <ul class="pagination">
                    <li class="page-item" :class="{ disabled: !transactions.links[0].url }">
                        <a class="page-link" :href="transactions.links[0].url" @click.prevent="goToPage(transactions.links[0].url)">
                            &laquo;
                        </a>
                    </li>
                    <li v-for="(link, index) in transactions.links.slice(1, -1)" :key="index" class="page-item" :class="{ active: link.active }">
                        <a class="page-link" :href="link.url" @click.prevent="goToPage(link.url)">
                            {{ link.label }}
                        </a>
                    </li>
                    <li class="page-item" :class="{ disabled: !transactions.links[transactions.links.length - 1].url }">
                        <a class="page-link" :href="transactions.links[transactions.links.length - 1].url" @click.prevent="goToPage(transactions.links[transactions.links.length - 1].url)">
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
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        AuthenticatedLayout,
    },
    props: {
        transactions: Object,
    },
    methods: {
        goToPage(url) {
            this.$inertia.get(url);
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString();
        },
        formatAmount(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            }).format(amount);
        },
        viewTransaction(id) {
            this.$inertia.get(`/transactions/${id}`);
        },
        editTransaction(id) {
            this.$inertia.get(`/transactions/${id}/edit`);
        },
        deleteTransaction(id) {
            if (confirm('Are you sure you want to delete this transaction?')) {
                this.$inertia.delete(`/transactions/${id}`);
            }
        },
        createTransaction() {
            this.$inertia.get('/transactions/create');
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
