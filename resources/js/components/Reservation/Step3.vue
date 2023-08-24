<template>
    <section>
        <form class="form" action="#" @submit.prevent="customerRegister">
            <div class="form-group">
                <input type="email" v-model="customer.eMail" autocomplete="customer.eMail" placeholder="Email" />
            </div>
            <div class="form-group">
                <input type="date" v-model="customer.birthDay" placeholder="Birthday ('day'/'month'/'year')" />
            </div>
            <div class="form-group cta-step">
                <div class="cta prev">
                    <p class="cta-color">
            <span class="link_wrap">
              <a class="link_text" href="#" @click.prevent="prevStep"><span class="arrow-prev"></span>Previous</a>
            </span>
                    </p>
                </div>
            </div>
            <div class="register-btn">
                <input type="submit" value="Créer mon compte" />
            </div>
        </form>
    </section>
</template>

<script>
export default {
    data() {
        return {
            customer: {
                eMail: '', // Initialize with empty values
                birthDay: '', // Initialize with empty values
                // Add other customer data fields here
            },
        };
    },
    methods: {
        customerRegister() {
            // Handle customer registration for Step 3
            // Optionally, perform any necessary validation or data manipulation
            // Emit an event to notify the parent component of completion
            this.$emit('customer-registered');
        },
        prevStep() {
            // Emit an event to notify the parent component to go back to the previous step
            this.$emit('prev');
        },
    },
};
</script>
