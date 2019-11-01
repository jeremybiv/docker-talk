<template>
    <d-modal v-if="registerModal" @close="hideRegister" id="registerModal" :centered="true">
        <d-modal-header>
            <d-modal-title>Sign up</d-modal-title>
        </d-modal-header>
        <d-modal-body>
            <div v-if="errors" class="error-feedback">
                <div v-for="error in errors">
                    {{ error[0] }}
                </div>
            </div>
            <d-form @submit.prevent="register" :autocomplete="'false'">
                <d-form-row>
                    <label>Name</label>
                    <d-input type="text" placeholder="John" v-model="registerForm.name" :state="registerForm.errors.has('name') ? 'invalid' : null"></d-input>
                    <d-invalid-feedback>
                        {{ registerForm.errors.get('name') }}
                    </d-invalid-feedback>
                </d-form-row>

                <d-form-row>
                    <label>Email</label>
                    <d-input type="email" placeholder="john@gmail.com" v-model="registerForm.email" :state="registerForm.errors.has('email') ? 'invalid' : null"></d-input>
                    <d-invalid-feedback>
                        {{ registerForm.errors.get('email') }}
                    </d-invalid-feedback>
                </d-form-row>

                <d-form-row>
                    <label>Password</label>
                    <d-input type="password" placeholder="Your password" v-model="registerForm.password" :state="registerForm.errors.has('password') ? 'invalid' : null"></d-input>
                    <d-invalid-feedback>
                        {{ registerForm.errors.get('password') }}
                    </d-invalid-feedback>
                </d-form-row>

                <d-form-row>
                    <label>Repeat password</label>
                    <d-input type="password" placeholder="Repeat your password" v-model="registerForm.password_confirmation" :state="registerForm.errors.has('password_confirmation') ? 'invalid' : null"></d-input>
                    <d-invalid-feedback>
                        {{ registerForm.errors.get('password_confirmation') }}
                    </d-invalid-feedback>
                </d-form-row>

                <d-form-row>
                    <d-button type="submit" block-level :disabled="loading">Sign up</d-button>
                </d-form-row>
                <d-form-row class="justify-content-center link-modal">
                    Already have an account? &nbsp;<a href="#" @click="showLogin">Log in here</a>
                </d-form-row>
                <span class="divider"> </span>
                <d-form-row class="justify-content-center link-modal">
                    <button class="btn btn-block btn-social btn-twitch" @click.prevent="socialAuthRegister('google')">
                        <i class="fab fa-2x fa-twitch align-middle"></i>
                        <span class="align-middle ml-1">Sign up with Google</span>
                    </button>
                   
                </d-form-row>
            </d-form>
        </d-modal-body>
    </d-modal>
</template>

<script>
import register from "../mixins/register";

export default {
    mixins: [register],
}
</script>
