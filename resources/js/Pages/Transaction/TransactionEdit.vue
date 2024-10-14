<template>
    <Head title="Edit Transaction" />
    <AuthenticatedLayout>
        <div class="container mt-4">
            <h2>Edit Transaction</h2>
            <form @submit.prevent="updateTransaction" class="mt-5">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" v-model="transaction.amount" class="form-control" id="amount" required />
                </div>
                <div class="form-group">
                    <label for="transaction_date">Transaction Date</label>
                    <input type="date" v-model="transaction.transaction_date" class="form-control" id="transaction_date" required />
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-success mr-3">Update</button>
                    <button type="button" class="btn btn-secondary" @click="$inertia.visit('/transactions')">Cancel</button>
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
        transaction: Object,
    },
    methods: {
        updateTransaction() {
            this.$inertia.put(`/transactions/${this.transaction.id}`, this.transaction);
        },
    },
};
</script>
