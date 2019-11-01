//import AlertDialog from "../../../services/alert.dialog";
import {mapMutations, mapActions} from 'vuex';

function loginForm() {
    return {
        email: null,
        password: null,
        remember: false,
    };
}

const Login = {
    props: ['show'],

    data() {
        return {
            loginForm: loginForm(),
            loginModal: false,
            errors: null,
            loading: false,
        };
    },

    mounted() {
        this.$eventHub.$on('loginModal', e => {
            this.$emit('open');
            this.errors = '';
            this.loginModal = true;
        });
    },

    methods: {
        ...mapActions({
           
            getUser: 'user/getAsync',
        }),

        ...mapMutations({
            setUser: 'user/set',
        }),

        socialAuthLogin(provider) {
            var self = this;

            this.$auth.authenticate(provider)
                .then(response =>{
                    self.socialLogin(provider, response);
                }).catch(err => {
                console.log({err: err});
            });
        },

        socialLogin(provider, response) {
            this.$http.post('/api/' + provider + '/login', response)
                .then(response => {
                    this.performLoginRitual(response.data);
                }).catch(err => {
                console.log({err: err});
            });
        },

        showLogin() {
            this.errors ='';
            this.loginModal = true;
        },

        showRegister() {
            this.hidelogin();
            this.$eventHub.$emit('registerModal');
        },

        reset() {
            

            this.setUser(null);
        },

        login() {
            this.loading = true;

            this.$http.post('/api/login', this.loginForm)
                .then(async (response) => {
                    // this.loginForm = new PlayForm(loginForm());
                    this.performLoginRitual(response);
                    // this.hideAllMenus();
                    this.loginModal = false;
                    this.errors = '';
                    this.loading = false;
                })
                .catch(error => {
                    this.errors = error.errors;
                    this.reset();
                    this.loading = false;
                });
        },

        async performLoginRitual(response) {
            
            this.setUser(response.data);

        },

        showForgotPassword() {
            this.$emit('forgotPassword');
            this.loginModal = false;
        },

        hidelogin() {
            this.$emit('close');
            this.loginModal = false;
            this.errors = '';
            this.loginForm = new PlayForm(loginForm());
        }
    },

    watch: {
        show: function() {
            if (this.show) {
                this.loginModal = true;
            }
        }
    }
};

export default Login;
