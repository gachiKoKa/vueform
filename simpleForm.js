var vm = new Vue({
    el: '#form',
    data: {
        errors: [],
        login: null,
        password: null
    },
    methods: {
        submitForm() {
            this.errors = []

            if (!this.login) {
                this.errors.push('Login is required')
            }

            if (!this.password) {
                this.errors.push('Password is required')
            }

            if (!this.errors.length) {
                axios.post('/login', {
                    login: this.login,
                    password: this.password
                })
                    .then((res) => {
                        console.log(res.data)
                        this.login = null
                        this.password = null
                    })
            } else {
                this.login = null
                this.password = null
            }
        }
    }
})