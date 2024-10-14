<template>
    <Head title="Edit Transaction" />
    <AuthenticatedLayout>
        <div class="container mt-4">
            <h2>Edit Transaction</h2>
            <form @submit.prevent="updateTransaction">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" v-model="transaction.amount" class="form-control" id="amount" required />
                </div>
                <div class="form-group">
                    <label for="transaction_date">Transaction Date</label>
                    <input type="date" v-model="transaction.transaction_date" class="form-control" id="transaction_date" required />
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <button class="btn btn-secondary" @click="$inertia.visit('/transactions')">Cancel</button>
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
        transaction: Object, // Current transaction data passed as a prop
    },
    methods: {
        updateTransaction() {
            this.$inertia.put(`/transactions/${this.transaction.id}`, this.transaction); // Send a PUT request to update the transaction
        },
    },
};
</script>
