<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Transaction Details
            </h2>
        </template>

        <div class="container mt-5">

            <div v-if="transaction">


                <p><strong>Client Name:</strong> {{ transaction.client.first_name }} {{ transaction.client.last_name }}</p>
                <p><strong>Transaction Date:</strong> {{ formatDate(transaction.transaction_date) }}</p>
                <p><strong>Amount:</strong> {{ formatAmount(transaction.amount) }}</p>


                <button class="btn btn-secondary mb-3 mt-3" @click="goBack">Back</button>

            </div>
            <div v-else>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    props: {
        transaction: Object,
    },
    components: {
        AuthenticatedLayout,
    },
    methods: {
        goBack() {
            this.$inertia.visit('/transactions');
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
    },
};
</script>
