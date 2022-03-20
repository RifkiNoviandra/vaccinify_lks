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
            <div class="container d-flex justify-content-between align-items-center" >
                <div>
                    <h1 class="display-4">{{spot_name}}</h1>
                    <span class="text-muted">{{address}}</span>
                </div>
                <router-link to="" href="" class="btn btn-primary" @click="insert_vaccinations">Register vaccination</router-link>
            </div>
        </header>
        <!-- E: Header -->

        <div class="container">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="vaccination-date">Select vaccination date</label>
                        <input type="date" class="form-control" id="vaccination-date" v-model="date" @change="getvacbydate">
                    </div>
                </div>
            </div>

            <div class="row mb-5">

                <!-- S: Session 1 -->
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4>Session 1</h4>
                                <span class="text-muted">09:00 - 11:00</span>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 1 && this.id !== 1"> #1 </div>
                                        <div class="slot" v-if="count_data.length < 1"> #1 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 1"> #1 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 2 && this.id !== 2"> #2 </div>
                                        <div class="slot" v-if="count_data.length < 2"> #2 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 2"> #2 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 3 && this.id !== 3" > #3 </div>
                                        <div class="slot" v-if="count_data.length < 3"> #3 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 3"> #3 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 4 && this.id !== 4"> #4 </div>
                                        <div class="slot" v-if="count_data.length < 4"> #4 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 4"> #4 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 5 && this.id !== 5"> #5 </div>
                                        <div class="slot" v-if="count_data.length < 5"> #5 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 5"> #5 </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- E: Session 1 -->

                <!-- S: Session 2 -->
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4>Session 2</h4>
                                <span class="text-muted">13:00 - 15:00</span>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 6 && this.id !== 6"> #6 </div>
                                        <div class="slot" v-if="count_data.length < 6"> #6 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 6"> #6 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 7 && this.id !== 7"> #7 </div>
                                        <div class="slot" v-if="count_data.length < 7"> #7 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 7"> #7 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 8 && this.id !== 8"> #8 </div>
                                        <div class="slot" v-if="count_data.length < 8"> #8 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 8"> #8 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 9 && this.id !== 9"> #9</div>
                                        <div class="slot" v-if="count_data.length < 9"> #9 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 9"> #9 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 10 && this.id !== 10"> #10 </div>
                                        <div class="slot" v-if="count_data.length < 10"> #10 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 10"> #10 </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- E: Session 2 -->

                <!-- S: Session 3 -->
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4>Session 3</h4>
                                <span class="text-muted">15:00 - 17:00</span>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 11 && this.id !== 11"> #11 </div>
                                        <div class="slot" v-if="count_data.length < 11"> #11 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 11"> #11 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 12 && this.id !== 12"> #12 </div>
                                        <div class="slot" v-if="count_data.length < 12"> #12 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 12"> #12 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 13 && this.id !== 13"> #13 </div>
                                        <div class="slot" v-if="count_data.length < 13"> #13 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 13"> #13 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 14 && this.id !== 14"> #14 </div>
                                        <div class="slot" v-if="count_data.length < 14"> #14 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 14"> #14 </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="slot filled" v-if="count_data.length >= 15 && this.id !== 15"> #15 </div>
                                        <div class="slot" v-if="count_data.length < 15"> #15 </div>
                                        <div class="slot bg-primary text-white" v-if="this.id === 15"> #15 </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- E: Session 3 -->

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
    name: 'detail',
    data(){
        return{
            data : [],
            name : "",
            spot_name : "",
            address : "",
            date : "",
            count_data: [],
            name_id: "",
            id : 0,
        }
    },
    methods : {
        async getspotbyid(){
            let id = this.$route.params.id
            console.log(id);
            let path = await window.axios.get(`api/v1/spots/${id}`);
            this.data = path.data[0][0];
            this.spot_name = path.data[0][0].spot.name
            this.address = path.data[0][0].spot.address
            this.date = path.data[0][0].date
            console.log(path.data[0][0].spot.name);
            console.log(this.data);
        },
        async getvacbydate(){
            let id = this.$route.params.id
            let input = {date : this.date}
            console.log(this.date);
            let path = await window.axios.post(`/api/v1/vaccinations/${id}` , input)
            this.count_data = path.data.data
            if (this.count_data.length > 0){
            //     console.log(this.count_data.indexOf({society_id : localStorage.getItem('id')}))
            //     console.log(localStorage.getItem('id'));
            //     console.log(this.count_data.findIndex( x => {return x.society_id === localStorage.getItem('id')}));
                let user_id = parseInt(localStorage.getItem('id'));
                if (this.count_data.map(object => object.society_id).indexOf(user_id) === -1){
                    this.id = 0
                }else {
                    this.id = this.count_data.map(object => object.society_id).indexOf(user_id) + 1
                }
            }
            console.log(this.count_data[0]);
        },

        async insert_vaccinations(){
            let id = this.$route.params.id
            let input = {date : this.date , spot_id:id}
            let path = await window.axios.post('/api/v1/vaccinations' , input)
            console.log(path);

            if (path.status === 200){
                this.$router.push('/home');
            }
        }
    },
    mounted() {
        this.id = localStorage.getItem('id');
        let today = new Date()
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        let yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;

        this.date = today
        this.name = localStorage.getItem('name')
        this.getspotbyid()
        this.getvacbydate()
    }
};
</script>

<style scoped>

</style>
