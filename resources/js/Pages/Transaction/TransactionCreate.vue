<template>
    <Head title="Create Transaction" />
    <AuthenticatedLayout>
        <div class="container mt-4">
            <h2>Create Transaction</h2>
            <form @submit.prevent="createTransaction">
                <div class="form-group">
                    <label for="client_id">Client</label>
                    <select v-model="form.client_id" class="form-control" id="client_id" required>
                        <option v-for="client in clients" :key="client.id" :value="client.id">
                            {{ client.first_name }} {{ client.last_name }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="transaction_date">Transaction Date</label>
                    <input type="date" v-model="form.transaction_date" class="form-control" id="transaction_date" required />
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" v-model="form.amount" class="form-control" id="amount" required />
                </div>
                <button type="submit" class="btn btn-primary">Create Transaction</button>
                <button type="button" class="btn btn-secondary" @click="$inertia.visit('/transactions')">Cancel</button>
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
        clients: Array, // List of clients passed as a prop
    },
    data() {
        return {
            form: {
                client_id: '',            // To hold the selected client ID
                transaction_date: '',     // To hold the transaction date
                amount: '',               // To hold the transaction amount
            },
        };
    },
    methods: {
        createTransaction() {
            this.$inertia.post('/transactions', this.form); // Send a POST request to create the transaction
        },
    },
};
</script>
