<template>
<div>
    <d-modal v-if="loginModal" @close="hidelogin" id="loginModal" :centered="true">
        <d-modal-header>
            <d-modal-title>Log in</d-modal-title>
        </d-modal-header>
        <d-modal-body>
            <div v-if="errors" class="error-feedback">
                <div v-for="error in errors">
                    {{ error[0] }}
                </div>
            </div>
            <d-form @submit.prevent="login">
                <d-form-row>
                    <label>Email</label>
                    <d-input type="email" placeholder="john@gmail.com" v-model="loginForm.email" :state="loginForm.errors.has('email') ? 'invalid' : null"></d-input>
                    <d-invalid-feedback>
                        {{ loginForm.errors.get('email') }}
                    </d-invalid-feedback>
                </d-form-row>
                <d-form-row>
                    <label>Password</label>
                    <d-input type="password" v-model="loginForm.password" :state="loginForm.errors.has('password') ? 'invalid' : null"></d-input>
                    <d-invalid-feedback>
                        {{ loginForm.errors.get('password') }}
                    </d-invalid-feedback>
                    <a class="mt-2 link-forgot" href="#" @click="showForgotPassword">Forgot password?</a>
                </d-form-row>
                <d-form-row>
                    <d-button type="submit" block-level>Log in</d-button>
                </d-form-row>
                <d-form-row class="justify-content-center link-modal">
                    Don't have an account yet? &nbsp;<a href="#"  @click="showRegister">Sign up here</a>
                </d-form-row>
                <span class="divider"> </span>
                <d-form-row class="justify-content-center link-modal">
                    <button class="btn btn-block btn-social btn-twitch" @click.prevent="socialAuthLogin('twitch')">
                        <i class="fab fa-2x fa-twitch align-middle"></i>
                        <span class="align-middle ml-1">Login with Twitch</span>
                    </button>
                    <button class="btn btn-block btn-social btn-discord" @click.prevent="socialAuthLogin('discord')">
                        <i class="fab fa-2x fa-discord align-middle"></i>
                        <span class="align-middle ml-1">Login with Discord</span>
                    </button>
                </d-form-row>
            </d-form>
        </d-modal-body>
    </d-modal>
</div>
</template>

<script>
//import login from "../../../../mixins/core/auth/login";

export default {
   // mixins: [login],
}
</script>
