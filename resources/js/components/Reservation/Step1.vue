<template>
    <form class="form" method="post" action="#" @submit.prevent="next">
        <div class="form-group">
            <input id="loyaltyCivilityMr" type="radio" value="1" v-model="customer.gender">
            <label class="input-label" for="loyaltyCivilityMr">Mr.</label>

            <input id="loyaltyCivilityMrs" type="radio" value="2" v-model="customer.gender">
            <label class="input-label" for="loyaltyCivilityMrs">Mrs.</label>
        </div>

        <div class="form-group">
            <input type="text" v-model="customer.firstName" autocomplete='customer.firstName' placeholder="First name" required />
            <input type="text" v-model="customer.lastName" autocomplete='customer.lastName' placeholder="Last name" required />
        </div>

        <div class="form-group">
            <input type="tel" v-model="customer.phoneNumber" autocomplete="customer.phoneNumber" placeholder="Phone number" minlength="9" maxlength="10" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" required />
        </div>
        <div class="cta" data-style="see-through" data-alignment="right" data-text-color="custom">
            <p class="cta-color">
							<span class="link_wrap">
								<input type="submit" value="Next" class="link_text" />
								<span class="arrow-next"></span>
							</span>
            </p>
        </div>
    </form>
</template>
<script setup>
</script>
