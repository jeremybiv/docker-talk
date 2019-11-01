<template>
    <d-modal v-if="registerSocialModal" @close="hideRegisterSocial" id="registerSocialModal" :centered="true">
        <d-modal-header>
            <d-modal-title>Sign up</d-modal-title>
        </d-modal-header>
        <d-modal-body>
            <div v-if="errors" class="error-feedback">
                <div v-for="error in errors">
                    {{ error[0] }}
                </div>
            </div>
            <d-form @submit.prevent="registerSocial" :autocomplete="'false'">
                <d-form-row>
                    <label>Email</label>
                    <d-input type="email" placeholder="john@gmail.com" v-model="registerSocialForm.email" :state="registerSocialForm.errors.has('email') ? 'invalid' : null"></d-input>
                    <d-invalid-feedback>
                        {{ registerSocialForm.errors.get('email') }}
                    </d-invalid-feedback>
                </d-form-row>
                <!--<d-form-row>
                    <d-checkbox v-model="registerSocialForm.terms" name="terms" value="1">Accept Terms of Service</d-checkbox>
                    <d-invalid-feedback>
                        {{ registerSocialForm.errors.get('terms') }}
                    </d-invalid-feedback>
                </d-form-row>
                -->
                <d-form-row>
                    <d-button type="submit" block-level :disabled="loading">Sign up</d-button>
                </d-form-row>
            </d-form>
        </d-modal-body>
    </d-modal>
</template>
