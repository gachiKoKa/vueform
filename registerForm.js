var vm = new Vue({
    el: '#register_form',
    data: {
        errors:[],
        login: null,
        email: null,
        password: null
    },
    methods: {
        submitRegisterForm() {
            this.errors = []

            if (!this.login) {
                this.errors.push('Login is required')
            }

            if (!this.email || !this.email.includes('@')) {
                this.errors.push('Invalid email')
            }

            if (!this.password) {
                this.errors.push('Password is required')
            }

            if (!this.errors.length) {
                axios.post('/register', {
                    login: this.login,
                    email: this.email,
                    password: this.password
                })
                    .then((res) => {
                        console.log(res.data)
                        this.login = null
                        this.email = null
                        this.password = null
                    })
                    .catch((error) => {
                        // console.log(error.message)
                    })
            } else {
                this.login = null
                this.email = null
                this.password = null
            }
        }
    }
})