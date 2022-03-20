<template>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Vaccination Platform</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link to="" class="nav-link" href="#">{{name}}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="" class="nav-link" href="#">Logout</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- S: Header -->
        <header class="jumbotron">
            <div class="container">
                <h1 class="display-4">First Vaccination</h1>
            </div>
        </header>
        <!-- E: Header -->

        <div class="container mb-5">

            <div class="section-header mb-4">
                <h4 class="section-title text-muted font-weight-normal">List Vaccination Spots in Central Jakarta</h4>
            </div>

            <div class="section-body">

                <article class="spot" v-for="(i , index) in data" @click="push_page(i.id)">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="text-primary">{{i.name}}</h5>
                            <span class="text-muted">{{i.address}}</span>
                        </div>
                        <div class="col-4">
                            <h5>Available vaccines</h5>
                            <span class="text-muted">{{ get_objectTrue( data[index] ) }}</span>
                        </div>
                        <div class="col-3">
                            <h5>Serve</h5>
                            <span class="text-muted" v-if="i.serve === 1">
                        Only first vaccination
                    </span>
                            <span class="text-muted" v-if="i.serve === 2">
                        Only second vaccination
                    </span>
                            <span class="text-muted" v-if="i.serve === 3">
                        First And second vaccination
                    </span>
                        </div>
                    </div>
                </article>

<!--                <article class="spot unavailable">-->
<!--                    <div class="row">-->
<!--                        <div class="col-5">-->
<!--                            <h5 class="text-primary">Nasyidah Hospital</h5>-->
<!--                            <span class="text-muted">Ki. Bakau Griya Utama No. 476, DKI Jakarta</span>-->
<!--                        </div>-->
<!--                        <div class="col-4">-->
<!--                            <h5>Available vaccines</h5>-->
<!--                            <span class="text-muted">Sinovac, AstraZeneca, Moderna, Pfizer.</span>-->
<!--                        </div>-->
<!--                        <div class="col-3">-->
<!--                            <h5>Serve</h5>-->
<!--                            <span class="text-muted">-->
<!--                        Only second vaccination-->
<!--                    </span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </article>-->

<!--                <article class="spot">-->
<!--                    <div class="row">-->
<!--                        <div class="col-5">-->
<!--                            <h5 class="text-primary">Napitupulu Hospital</h5>-->
<!--                            <span class="text-muted">Jln. Laswi No. 228, DKI Jakarta</span>-->
<!--                        </div>-->
<!--                        <div class="col-4">-->
<!--                            <h5>Available vaccines</h5>-->
<!--                            <span class="text-muted">Sinovac, AstraZeneca, Sinnopharm.</span>-->
<!--                        </div>-->
<!--                        <div class="col-3">-->
<!--                            <h5>Serve</h5>-->
<!--                            <span class="text-muted">-->
<!--                        Both vaccination-->
<!--                    </span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </article>-->

<!--                <article class="spot">-->
<!--                    <div class="row">-->
<!--                        <div class="col-5">-->
<!--                            <h5 class="text-primary">Nugroho Hospital</h5>-->
<!--                            <span class="text-muted">Ki. Bagis Utama No. 325, DKI Jakarta</span>-->
<!--                        </div>-->
<!--                        <div class="col-4">-->
<!--                            <h5>Available vaccines</h5>-->
<!--                            <span class="text-muted">Sinovac, AstraZeneca, Sinnopharm.</span>-->
<!--                        </div>-->
<!--                        <div class="col-3">-->
<!--                            <h5>Serve</h5>-->
<!--                            <span class="text-muted">-->
<!--                        Only first vaccination-->
<!--                    </span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </article>-->

<!--                <article class="spot">-->
<!--                    <div class="row">-->
<!--                        <div class="col-5">-->
<!--                            <h5 class="text-primary">Megantara Hospital</h5>-->
<!--                            <span class="text-muted">Gg. Sam Ratulangi No. 503, DKI Jakarta</span>-->
<!--                        </div>-->
<!--                        <div class="col-4">-->
<!--                            <h5>Available vaccines</h5>-->
<!--                            <span class="text-muted">Sinovac, AstraZeneca, Sinnopharm.</span>-->
<!--                        </div>-->
<!--                        <div class="col-3">-->
<!--                            <h5>Serve</h5>-->
<!--                            <span class="text-muted">-->
<!--                        Only first vaccination-->
<!--                    </span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </article>-->

            </div>

        </div>

    </main>

    <!-- S: Footer -->
    <footer>
        <div class="container">
            <div class="text-center py-4 text-muted">
                Copyright &copy; 2021 - Web Tech ID
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'first_vaccination',
    data(){
        return{
            data : [],
            name: "",
            avaible_vaccines : "",
        }
    },

    methods : {
        async get_spot_data(){
            let path = await window.axios.get('/api/v1/spots')
            console.log(path);
            this.data = path.data.spots
            console.log(this.data);
        },

        get_objectTrue(data){
            this.avaible_vaccines = "";
            if (data.available_vaccines.Sinovac === true){
                this.avaible_vaccines += "Sinovac,"
            }if (data.available_vaccines.AstraZeneca === true){
                this.avaible_vaccines += "AstraZeneca,"
            }if (data.available_vaccines.Moderna === true){
                this.avaible_vaccines += "Moderna,"
            }if (data.available_vaccines.Pfizer === true){
                this.avaible_vaccines += "Pfizer,"
            }if (data.available_vaccines.Sinnopharm === true){
                this.avaible_vaccines += "Sinnopharm,"
            }

            return this.avaible_vaccines
        },
        push_page(id){
            this.$router.push(`/detail/${id}`);
        }
    },
    mounted() {
        this.name = localStorage.getItem('name')
        this.get_spot_data()
    }
};
</script>

<style scoped>

</style>
