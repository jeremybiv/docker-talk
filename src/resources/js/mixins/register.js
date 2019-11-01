import {mapMutations, mapActions} from 'vuex';

function registerForm() {
    return {
        name: null,
        username: null,
        email: null,
        password: null,
        password_confirmation: null,
        referral: null,
        terms: false,
    };
}

const Register = {
    props: ['show'],

    data() {
        return {
            registerForm: registerForm(),
            registerSocialForm: {},
            registerModal: false,
            registerSocialModal: false,
            errors: null,
            loading: false,
        };
    },

    created() {
       
    },

    mounted() {
        this.$eventHub.$on('registerModal', e => {
            this.$emit('open');
            this.errors = '';
            this.registerModal = true;
        });

        
    },

    computed: {
    },

    methods: {
        

        ...mapMutations({
            setUser: 'user/set',
        }),

        socialAuthRegister(provider) {
            var self = this;

            this.$auth.authenticate(provider)
                .then(response =>{
                    self.socialRegister(provider, response);
                }).catch(err => {
                console.log({err: err});
            });
        },

        async performRegisterRitual(response) {
            this.registerForm = registerForm();
            
            this.setUser(response.data);
            this.$eventHub.$emit('login', response.data);
            this.errors = '';

            this.loading = false;
        },

        socialRegister(provider, response) {
            this.$http.post('/api/' + provider + '/register', response)
                .then(response => {
                    this.performRegisterRitual(response.data);
                }).catch(err => {
                if (err.response.status === 422) {
                    this.registerSocialForm.driver = err.response.data.data.driver;
                    this.registerSocialForm.email = err.response.data.data.email;
                    this.registerSocialForm.name = err.response.data.data.name;
                    this.registerSocialForm.username = err.response.data.data.username;
                    this.registerSocialForm.id = err.response.data.data.id;
                    this.registerSocialForm.handle = err.response.data.data.handle;

                    this.hideRegister();
                    this.showRegisterSocial();

                    this.errors = err.response.data.errors;
                }
            });
        },

        register() {
            this.loading = true;


            this.$http.post('/api/register', this.registerForm)
                .then(response => {
                    this.performRegisterRitual(response);
                    // this.hideAllMenus();
                    this.registerModal = false;
                    this.errors = '';
                    this.loading = false;
                })
                .catch(error => {
                    this.errors = error.errors;
                    this.loading = false;
                });
        },

        registerSocial() {
            this.loading = true;

            this.$http.post('/api/' + this.registerSocialForm.driver + '/register-social', this.registerSocialForm)
                .then(async (response) => {
                    this.performRegisterRitual(response);
                })
                .catch(error => {
                    this.errors = error.errors;

                    this.loading = false;
                });
        },

        showRegister() {
            this.errors ='';
            this.registerModal = true;
            this.loginModal = false;
            this.forgotPasswordModal = false;
        },

        showLogin() {
            this.hideRegister();
            this.$eventHub.$emit('loginModal');
        },

        hideRegister() {
            this.$emit('close');
            this.registerModal = false;
            this.errors = '';
            this.registerForm = new PlayForm(registerForm());
        },

        showRegisterSocial() {
            this.registerSocialModal = true;
            this.loginModal = false;
            this.forgotPasswordModal = false;
        },

        hideRegisterSocial() {
            this.registerSocialModal = false;
            this.errors = '';
            this.registerForm = new PlayForm(registerForm());
        },
    },

    watch: {
        show: function() {
            if (this.show) {
                this.registerModal = true;
            }
        }
    }
};

export default Register;
