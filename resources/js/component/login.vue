<template>
<!--    <h1>Hello World</h1>-->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Vaccination Platform</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- S: Header -->
        <header class="jumbotron">
            <div class="container text-center">
                <h1 class="display-4">Vaccination Platform</h1>
            </div>
        </header>
        <!-- E: Header -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form class="card card-default" @submit.prevent>
                        <div class="card-header">
                            <h4 class="mb-0">Login</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <div class="col-4 text-right">ID Card Number</div>
                                <div class="col-8"><input type="text" class="form-control" v-model="id_number"></div>
                            </div>
                            <div class="form-group row align-items-center">
                                <div class="col-4 text-right">Password</div>
                                <div class="col-8"><input type="password" class="form-control" v-model="password"></div>
                            </div>
                            <div class="form-group row align-items-center mt-4">
                                <div class="col-4"></div>
                                <div class="col-8"><button class="btn btn-primary" type="submit" @click="login_user">Login</button></div>
                            </div>
                            <div class="container-fluid text-center text-danger" v-if="status === true">Id atau Password Salah</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: 'login',
    data(){
        return{
            login_data : [],
            id_number : "",
            password : "",
            status : false
        }
    },
    methods : {
        async login_user(){
            let input = {id_card_number : this.id_number , password : this.password}
            this.status = true
            let path = await window.axios.post('/api/v1/auth/login' , input)
            if (path.status === 200){
                this.status = false
                this.login_data = path.data[0]
                console.log(this.login_data.login_tokens);
                console.log(this.login_data);
                let token = this.login_data.login_tokens;
                localStorage.setItem('name' , this.login_data.name)
                localStorage.setItem('token' , token)
                localStorage.setItem('id' , this.login_data.id)
                this.$router.push('/home')
            }
        }
    }
};
</script>

<style scoped>

</style>
